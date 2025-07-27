<?php

namespace App\Filament\Resources;

use App\Filament\Resources\APBDResource\Pages;
use App\Filament\Resources\ApbdResource\Widgets\ApbdTable;
use App\Models\Lkpd\Apbd;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class APBDResource extends Resource
{
    protected static ?string $model = Apbd::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'APBD';

    protected static ?string $navigationLabel = 'APBD';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Apbd::query()->orderBy('kode_rekening')
            )
            ->columns([
                TextColumn::make('kode_rekening')->label('Kode')
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null),
                TextColumn::make('nama_rekening')
                    ->label('Uraian')
                    ->limit(50)
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null)
                    ->html()
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level); // 4 spasi per level

                        if ($level === 0) {
                            return $indent . e($record->nama_rekening);
                        } elseif ($level === 1) {
                            return $indent . e($record->uraian);
                        } else {
                            return $indent . e($record->sub_uraian);
                        }
                    }),
                TextColumn::make('jml_anggaran_sebelum')
                    ->label('Murni')
                    ->color(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? 'success' : null)
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null)
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        $prefix = $kode . '.';

                        $nilaiArray = [];

                        if ($level === 0) {
                            // Hitung total dari level 1
                            $items = Apbd::where('kode_rekening', 'LIKE', $prefix . '%')
                                ->whereRaw("(LENGTH(kode_rekening) - LENGTH(REPLACE(kode_rekening, '.', ''))) = 1")
                                ->where('tahun_anggaran', $record->tahun_anggaran)
                                ->get();

                            foreach ($items as $item) {
                                $nilaiArray[] = $item->jml_anggaran_sebelum ?? 0;
                            }

                            $total = array_sum($nilaiArray);
                            return 'Rp ' . number_format($total, 0, ',', '.');
                        }

                        if ($level === 1) {
                            // Hitung total dari level 2
                            $items = Apbd::where('kode_rekening', 'LIKE', $prefix . '%')
                                ->whereRaw("(LENGTH(kode_rekening) - LENGTH(REPLACE(kode_rekening, '.', ''))) = 2")
                                ->where('tahun_anggaran', $record->tahun_anggaran)
                                ->get();

                            foreach ($items as $item) {
                                $nilaiArray[] = $item->jml_anggaran_sebelum ?? 0;
                            }

                            $total = array_sum($nilaiArray);
                            return 'Rp ' . number_format($total, 0, ',', '.');
                        }

                        // Untuk level 2 atau lebih dalam, tampilkan nilai langsung
                        $nilai = $record->jml_anggaran_sebelum ?? 0;
                        return 'Rp ' . number_format($nilai, 0, ',', '.');
                    }),
                TextColumn::make('jml_anggaran_setelah')
                    ->label('Perubahan')
                    ->color(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? 'success' : null)
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null)
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        $prefix = $kode . '.';
                        $nilaiArray = [];

                        if ($level === 0) {
                            // Hitung total dari level 1
                            $items = Apbd::where('kode_rekening', 'LIKE', $prefix . '%')
                                ->whereRaw("(LENGTH(kode_rekening) - LENGTH(REPLACE(kode_rekening, '.', ''))) = 1")
                                ->where('tahun_anggaran', $record->tahun_anggaran)
                                ->get();

                            foreach ($items as $item) {
                                $nilaiArray[] = $item->jml_anggaran_setelah ?? 0;
                            }

                            $total = array_sum($nilaiArray);
                            return 'Rp ' . number_format($total, 0, ',', '.');
                        }

                        if ($level === 1) {
                            // Hitung total dari level 2
                            $items = Apbd::where('kode_rekening', 'LIKE', $prefix . '%')
                                ->whereRaw("(LENGTH(kode_rekening) - LENGTH(REPLACE(kode_rekening, '.', ''))) = 2")
                                ->where('tahun_anggaran', $record->tahun_anggaran)
                                ->get();

                            foreach ($items as $item) {
                                $nilaiArray[] = $item->jml_anggaran_setelah ?? 0;
                            }

                            $total = array_sum($nilaiArray);
                            return 'Rp ' . number_format($total, 0, ',', '.');
                        }

                        // Untuk level 2 atau lebih dalam, tampilkan nilai langsung
                        $nilai = $record->jml_anggaran_setelah ?? 0;
                        return 'Rp ' . number_format($nilai, 0, ',', '.');
                    }),
                TextColumn::make('selisih_anggaran')->label('Selisih')
                    ->money('IDR', true),
                TextColumn::make('persen')->suffix('%')->label('%'),
            ])
            ->paginated(false)
            ->filters([
                SelectFilter::make('tahun_anggaran')
                    ->label('Tahun')
                    ->options(function () {
                        return Apbd::query()
                            ->select('tahun_anggaran')
                            ->distinct()
                            ->orderByDesc('tahun_anggaran')
                            ->pluck('tahun_anggaran', 'tahun_anggaran');
                    })
                    ->default(function () {
                        $default = date('Y');

                        $exists = Apbd::where('tahun_anggaran', $default)->exists();

                        if ($exists) return $default;

                        return Apbd::max('tahun_anggaran');
                    })
                    ->query(function ($query, $state) {
                        return $query->where('tahun_anggaran', $state);
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAPBDS::route('/'),
            'create' => Pages\CreateAPBD::route('/create'),
            'edit' => Pages\EditAPBD::route('/{record}/edit'),
        ];
    }
}

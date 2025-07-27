<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealisasiAnggaranResource\Pages;
use App\Helpers\Apbd as HelpersApbd;
use App\Models\Lkpd\Apbd;
use App\Models\Lkpd\LaporanRealisasiAnggaran;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RealisasiAnggaranResource extends Resource
{
    protected static ?string $model = LaporanRealisasiAnggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationGroup = 'APBD';

    protected static ?string $navigationLabel = 'Realisasi Anggaran';

    protected static ?int $navigationSort = 3;

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
                LaporanRealisasiAnggaran::query()->with('apbd')->orderBy('kode_rekening')
            )
            ->columns([
                TextColumn::make('kode_rekening')->label('Kode')
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null),
                TextColumn::make('apbd.nama_rekening')
                    ->label('Uraian')
                    ->limit(50)
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null)
                    ->html()
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level); // 4 spasi per level

                        if ($level === 0) {
                            return $indent . e($record->apbd->nama_rekening);
                        } elseif ($level === 1) {
                            return $indent . e($record->apbd->uraian);
                        } else {
                            return $indent . e($record->apbd->sub_uraian);
                        }
                    }),
                TextColumn::make('apbd.jml_anggaran_setelah')
                    ->label('Anggaran')
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
                        $nilai = $record->apbd?->jml_anggaran_setelah ?? 0;
                        return 'Rp ' . number_format($nilai, 0, ',', '.');
                    }),
                TextColumn::make('anggaran_terealisasi')
                    ->label('Realisasi')
                    ->color(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? 'success' : null)
                    ->weight(fn($state, $record) => substr_count($record->kode_rekening, '.') != 2 ? FontWeight::Bold : null)
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        if ($level === 0) {
                            $prefix = $kode . '.';

                            // Ambil semua record level 1 yang cocok
                            $items = Apbd::with('realisasi')
                                ->where('kode_rekening', 'LIKE', $prefix . '%')
                                ->whereRaw("(LENGTH(kode_rekening) - LENGTH(REPLACE(kode_rekening, '.', ''))) = 1")
                                ->whereHas('realisasi', function ($query) use ($record) {
                                    $query->where('tahun_anggaran', $record->tahun_anggaran);
                                })
                                ->get();

                            $nilaiArray = [];

                            foreach ($items as $item) {
                                $nilaiArray[] = $item->realisasi->anggaran_terealisasi ?? 0;
                            }

                            $total = array_sum($nilaiArray);

                            return 'Rp ' . number_format($total, 0, ',', '.');
                        }

                        // Untuk level 1 dan 2
                        $nilai = $record->anggaran_terealisasi ?? 0;
                        return 'Rp ' . number_format($nilai, 0, ',', '.');
                    }),
                TextColumn::make('apbd.persen')
                    ->label('5 = (4 / 3) * 100')
                    ->formatStateUsing(function ($state, $record) {
                        $kodeRekening = $record->kode_rekening;
                        $anggaran = $record->apbd->jml_anggaran_setelah ?? 0;
                        $realisasi = HelpersApbd::SumSubLRA($kodeRekening);

                        if ($anggaran > 0) {
                            return number_format(($realisasi / $anggaran) * 100, 2) . '%';
                        }

                        return '0.00%';
                    }),
            ])
            ->paginated(false)
            ->filters([
                SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->options(function () {
                        return LaporanRealisasiAnggaran::with('apbd')
                            ->select('tahun_anggaran')
                            ->distinct()
                            ->orderBy('tahun_anggaran', 'desc')
                            ->pluck('tahun_anggaran', 'tahun_anggaran')
                            ->toArray();
                    })
                    ->default(function () {
                        $default = date('Y');

                        $exists = LaporanRealisasiAnggaran::with('apbd')
                        ->where('tahun_anggaran', $default)
                        ->exists();

                        if ($exists) return $default;

                        return LaporanRealisasiAnggaran::max('tahun_anggaran');
                    })
                    ->query(function ($query, $state) {
                        return $query->where('tahun_anggaran', $state);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        return substr_count($record->kode_rekening, '.') > 1;
                    }),
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
            'index' => Pages\ListRealisasiAnggarans::route('/'),
            'create' => Pages\CreateRealisasiAnggaran::route('/create'),
            'edit' => Pages\EditRealisasiAnggaran::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealisasiAnggaranResource\Pages;
use App\Helpers\Apbd as HelpersApbd;
use App\Models\Lkpd\Apbd;
use App\Models\Lkpd\LaporanRealisasiAnggaran;
use Filament\Forms\Form;
use Filament\Resources\Resource;
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
                TextColumn::make('kode_rekening')->label('Kode'),
                TextColumn::make('apbd.nama_rekening')
                    ->label('Uraian')
                    ->limit(50)
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
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        if ($level === 0) {
                            return '';
                        }

                        $nilai = $record->apbd?->jml_anggaran_setelah ?? 0;
                        return 'Rp ' . number_format($nilai, 0, ',', '.');
                    }),
                TextColumn::make('anggaran_terealisasi')
                    ->label('Realisasi')
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;
                        $level = substr_count($kode, '.');

                        if ($level === 0) {
                            return '';
                        } elseif ($level === 1) {
                            $nilai = HelpersApbd::SumSubLRA($kode);
                            return 'Rp ' . number_format($nilai, 0, ',', '.');
                        } else {
                            return 'Rp ' . number_format($record->anggaran_terealisasi, 0, ',', '.');
                        }
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
            ->filters([
                Tables\Filters\SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->options(function () {
                        return Apbd::select('tahun_anggaran')
                            ->distinct()
                            ->orderBy('tahun_anggaran', 'desc')
                            ->pluck('tahun_anggaran', 'tahun_anggaran')
                            ->toArray();
                    })
                    ->default(date('Y'))
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

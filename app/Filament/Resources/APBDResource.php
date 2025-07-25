<?php

namespace App\Filament\Resources;

use App\Filament\Resources\APBDResource\Pages;
use App\Filament\Resources\ApbdResource\Widgets\ApbdTable;
use App\Models\Lkpd\Apbd;
use Filament\Forms\Form;
use Filament\Resources\Resource;
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
                TextColumn::make('kode_rekening')->label('Kode'),
                TextColumn::make('uraian')
                    ->label('Uraian')
                    ->limit(50)
                    ->formatStateUsing(function ($state, $record) {
                        $kode = $record->kode_rekening;

                        // Hitung jumlah titik
                        $level = substr_count($kode, '.');

                        if ($level === 0) {
                            return $record->nama_rekening; // contoh: 4
                        } elseif ($level === 1) {
                            return $record->uraian; // contoh: 4.1
                        } else {
                            return $record->sub_uraian; // contoh: 4.1.01 dst
                        }
                    }),
                TextColumn::make('jml_anggaran_sebelum')->label('Murni')
                    ->money('IDR', true),
                TextColumn::make('jml_anggaran_setelah')->label('Perubahan')
                    ->money('IDR', true),
                TextColumn::make('selisih_anggaran')->label('Selisih')
                    ->money('IDR', true),
                TextColumn::make('persen')->suffix('%')->label('%'),
            ])
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
                    ->default(date('Y'))
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

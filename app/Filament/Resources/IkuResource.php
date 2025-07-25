<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IkuResource\Pages;
use App\Models\Lkpd\IkuRealisasi;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IkuResource extends Resource
{
    protected static ?string $model = IkuRealisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationGroup = 'Iku & Realisasi';

    protected static ?string $navigationLabel = 'IKU';

    protected static ?int $navigationSort = 5;

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
            ->columns([
                TextColumn::make('sasaran.sasaran_strategis')
                    ->label('Sasaran Strategis'),

                TextColumn::make('bidang.nama')
                    ->label('Bidang'),

                TextColumn::make('iK.nama_indikator')
                    ->label('Indikator Kinerja'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListIkus::route('/'),
            'create' => Pages\CreateIku::route('/create'),
            'edit' => Pages\EditIku::route('/{record}/edit'),
        ];
    }
}

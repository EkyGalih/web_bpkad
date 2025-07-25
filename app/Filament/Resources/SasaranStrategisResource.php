<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SasaranStrategisResource\Pages;
use App\Models\Lkpd\SasaranStrategis;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SasaranStrategisResource extends Resource
{
    protected static ?string $model = SasaranStrategis::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Iku & Realisasi';

    protected static ?string $navigationLabel = 'Sasaran Strategis';

    protected static ?int $navigationSort = 1;

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
                TextColumn::make('sasaran_strategis')
                    ->label('Sasaran Strategis'),
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
            'index' => Pages\ListSasaranStrategis::route('/'),
            'create' => Pages\CreateSasaranStrategis::route('/create'),
            'edit' => Pages\EditSasaranStrategis::route('/{record}/edit'),
        ];
    }
}

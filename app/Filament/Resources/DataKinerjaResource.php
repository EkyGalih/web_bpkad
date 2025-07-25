<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataKinerjaResource\Pages;
use App\Filament\Resources\DataKinerjaResource\RelationManagers;
use App\Models\DataKinerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataKinerjaResource extends Resource
{
    protected static ?string $model = DataKinerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Iku & Realisasi';

    protected static ?string $navigationLabel = 'Data Kinerja';

    protected static ?int $navigationSort = 4;

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
                //
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
            'index' => Pages\ListDataKinerjas::route('/'),
            'create' => Pages\CreateDataKinerja::route('/create'),
            'edit' => Pages\EditDataKinerja::route('/{record}/edit'),
        ];
    }
}

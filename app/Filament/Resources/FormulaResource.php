<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulaResource\Pages;
use App\Models\Lkpd\Formulasi;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormulaResource extends Resource
{
    protected static ?string $model = Formulasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Iku & Realisasi';

    protected static ?string $navigationLabel = 'Formulasi';

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
            'index' => Pages\ListFormulas::route('/'),
            'create' => Pages\CreateFormula::route('/create'),
            'edit' => Pages\EditFormula::route('/{record}/edit'),
        ];
    }
}

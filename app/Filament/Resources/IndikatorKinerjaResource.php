<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndikatorKinerjaResource\Pages;
use App\Models\Lkpd\IndikatorKinerja;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IndikatorKinerjaResource extends Resource
{
    protected static ?string $model = IndikatorKinerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Iku & Realisasi';

    protected static ?string $navigationLabel = 'Indikator Kinerja';

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
            'index' => Pages\ListIndikatorKinerjas::route('/'),
            'create' => Pages\CreateIndikatorKinerja::route('/create'),
            'edit' => Pages\EditIndikatorKinerja::route('/{record}/edit'),
        ];
    }
}

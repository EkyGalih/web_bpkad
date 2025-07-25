<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KodeRekeningResource\Pages;
use App\Models\Lkpd\KodeRekening;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KodeRekeningResource extends Resource
{
    protected static ?string $model = KodeRekening::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?string $navigationGroup = 'APBD';

    protected static ?string $navigationLabel = 'Kode Rekening';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_rekening')
                    ->label('Nama Rekening')
                    ->required(),
                TextInput::make('kode_rekening')
                    ->label('Kode Rekening')
                    ->required(),
                TextInput::make('ref')
                    ->label('Ref'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_rekening')
                    ->label('Nama Rekening')
                    ->searchable(),
                TextColumn::make('kode_rekening')
                    ->label('Kode Rekening')
                    ->searchable(),
                TextColumn::make('ref')
                    ->label('Referensi')
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
            'index' => Pages\ListKodeRekening::route('/'),
            'create' => Pages\CreateKodeRekening::route('/create'),
            'edit' => Pages\EditKodeRekening::route('/{record}/edit'),
        ];
    }
}

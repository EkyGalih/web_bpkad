<?php

namespace App\Filament\Resources\KodeRekeningResource\Pages;

use App\Filament\Resources\KodeRekeningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKodeRekening extends ListRecords
{
    protected static string $resource = KodeRekeningResource::class;

    public function getTitle(): string
    {
        return 'Daftar Kode Rekening';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kode Rekening')
                ->icon('heroicon-m-plus'),
        ];
    }
}

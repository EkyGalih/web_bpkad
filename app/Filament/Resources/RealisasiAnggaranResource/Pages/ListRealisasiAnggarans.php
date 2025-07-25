<?php

namespace App\Filament\Resources\RealisasiAnggaranResource\Pages;

use App\Filament\Resources\RealisasiAnggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealisasiAnggarans extends ListRecords
{
    protected static string $resource = RealisasiAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

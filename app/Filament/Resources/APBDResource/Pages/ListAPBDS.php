<?php

namespace App\Filament\Resources\APBDResource\Pages;

use App\Filament\Resources\APBDResource;
use App\Filament\Resources\ApbdResource\Widgets\ApbdTable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAPBDS extends ListRecords
{
    protected static string $resource = APBDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

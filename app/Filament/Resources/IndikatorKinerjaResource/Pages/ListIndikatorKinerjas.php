<?php

namespace App\Filament\Resources\IndikatorKinerjaResource\Pages;

use App\Filament\Resources\IndikatorKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndikatorKinerjas extends ListRecords
{
    protected static string $resource = IndikatorKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

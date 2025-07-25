<?php

namespace App\Filament\Resources\DataKinerjaResource\Pages;

use App\Filament\Resources\DataKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataKinerja extends EditRecord
{
    protected static string $resource = DataKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

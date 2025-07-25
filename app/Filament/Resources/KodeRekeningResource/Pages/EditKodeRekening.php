<?php

namespace App\Filament\Resources\KodeRekeningResource\Pages;

use App\Filament\Resources\KodeRekeningResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditKodeRekening extends EditRecord
{
    protected static string $resource = KodeRekeningResource::class;

    protected function aftersave(): void
    {
        $this->redirect(KodeRekeningResource::getUrl('index'));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-m-trash'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
            Action::make('cancel')
                ->label('Batal')
                ->url(static::getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}

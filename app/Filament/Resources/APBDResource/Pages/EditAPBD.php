<?php

namespace App\Filament\Resources\APBDResource\Pages;

use App\Filament\Resources\APBDResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAPBD extends EditRecord
{
    protected static string $resource = APBDResource::class;

    /**
     * Override untuk membatasi akses edit berdasarkan level kode_rekening.
     */
    public function mount($record): void
    {
        parent::mount($record);

        // Validasi level kode rekening
        $level = substr_count($this->record->kode_rekening, '.');

        if ($level <= 1) {
            abort(403, 'Tidak diizinkan mengedit data ini.');
        }
    }

    /**
     * Aksi-aksi yang muncul di header halaman edit.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Enum;

enum KlasifikasiEnum: string
{
    case BERKALA = 'berkala';
    case SERTA_MERTA = 'serta merta';
    case SETIAP_SAAT = 'setiap saat';
    case DIKECUALIKAN = 'dikecualikan';

    public function isBerkala(): bool
    {
        return $this == self::BERKALA;
    }
    public function isSertaMerta(): bool
    {
        return $this == self::SERTA_MERTA;
    }
    public function isSetiapSaat(): bool
    {
        return $this == self::SETIAP_SAAT;
    }
    public function isDikecualikan(): bool
    {
        return $this == self::DIKECUALIKAN;
    }
    public function getLabel(): string
    {
        return match ($this) {
            self::BERKALA => 'Berkala',
            self::SERTA_MERTA => 'Serta Merta',
            self::SETIAP_SAAT => 'Setiap Saat',
            self::DIKECUALIKAN => 'Dikecualikan',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::BERKALA => 'info',
            self::SERTA_MERTA => 'success',
            self::SETIAP_SAAT => 'warning',
            self::DIKECUALIKAN => 'danger',
        };
    }
}

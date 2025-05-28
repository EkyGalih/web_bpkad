<?php

namespace App\Enum;

enum CategoryEnum: string
{
    case BERITA = 'Berita';
    case ARTIKEL = 'Artikel';
    case AGENDAPIMPINAN = 'Agenda-Pimpinan';

    public function isBerita(): bool
    {
        return $this == self::BERITA;
    }

    public function isArtikel(): bool
    {
        return $this == self::ARTIKEL;
    }

    public function isAgendaPimpinan(): bool
    {
        return $this == self::AGENDAPIMPINAN;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::BERITA => 'success',
            self::ARTIKEL => 'info',
            self::AGENDAPIMPINAN => 'primary'
        };
    }

}

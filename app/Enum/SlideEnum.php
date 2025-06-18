<?php

namespace App\Enum;

enum SlideEnum: string
{
    case SLIDER = 'slider';
    case INFORMASI = 'informasi';

    public function isSlider(): bool
    {
        return $this == self::SLIDER;
    }

    public function isInformasi(): bool
    {
        return $this == self::INFORMASI;
    }
}

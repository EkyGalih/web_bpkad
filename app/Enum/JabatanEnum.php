<?php

namespace App\Enum;

enum JabatanEnum: string
{
    case KABAN = "Kepala Badan";
    case SEKBAN = "Sekertaris Badan";
    case KABID = "Kepala Bidang";
    case KASUBID = "Kepala Sub Bidang";
    case PEGAWAI = "Pegawai";
    case KEPALA = "Kepala UPT";
    case FUNGSIONAL = "Fungsional";

    public function is(string $value): bool
    {
        return $this->value === $value;
    }
}

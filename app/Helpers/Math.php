<?php

namespace App\Helpers;

class Math
{
    public static function CurrencyConvert($data)
    {
        $explode = explode(".", $data);
        $implode = implode("", $explode);
        return $implode;
    }

    public static function CurrencyConvertComa($data)
    {
        $explode = explode(",", $data);
        $implode = implode("", $explode);
        return $implode;
    }

    public static function ConvertPersen($persen)
    {
        if ($persen < 0) {
            $persen = abs(round($persen));
        } else {
            $persen = round($persen);
        }
        return $persen;
    }

    public static function GenerateString($param)
    {
        return bin2hex(random_bytes($param));
    }
}

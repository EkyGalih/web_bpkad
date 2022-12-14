<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Pages;
use App\Models\Rule;
use App\Models\SubPages;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    // Function For Menu

    public static function Menu()
    {
        return Menu::select('menu.id as menu_id', 'menu.*')->orderBy('order_pos', 'ASC')->get();
    }

    public static function Pages($param)
    {
        return Pages::where('menu_id', '=', $param)->select('pages.title', 'pages.id as sub_menu_id')->get();
    }

    public static function SubPages($param)
    {
        return SubPages::where('sub_pages_id', '=', $param)->select('sub_pages.title', 'sub_pages.id as sub_menu_id')->get();
    }


    // Custom Function

    public static function GetDate($param)
    {
        $explode    = explode(" ", $param);
        $date       = explode("-", $explode[0]);
        $time       = explode(":", $explode[1]);
        if ($date[1] == '01') {
            $date = 'Jan '.$date[2].", ".$date[0];
        } elseif ($date[1] == '02') {
            $date = 'Feb '.$date[2].", ".$date[0];
        } elseif ($date[1] == '03') {
            $date = 'Mar '.$date[2].", ".$date[0];
        } elseif ($date[1] == '04') {
            $date = 'Apr '.$date[2].", ".$date[0];
        } elseif ($date[1] == '05') {
            $date = 'Mei '.$date[2].", ".$date[0];
        } elseif ($date[1] == '06') {
            $date = 'Jun '.$date[2].", ".$date[0];
        } elseif ($date[1] == '07') {
            $date = 'Jul '.$date[2].", ".$date[0];
        } elseif ($date[1] == '08') {
            $date = 'Aug '.$date[2].", ".$date[0];
        } elseif ($date[1] == '09') {
            $date = 'Sep '.$date[2].", ".$date[0];
        } elseif ($date[1] == '10') {
            $date = 'Oct '.$date[2].", ".$date[0];
        } elseif ($date[1] == '11') {
            $date = 'Nov '.$date[2].", ".$date[0];
        } elseif ($date[1] == '12') {
            $date = 'Dec '.$date[2].", ".$date[0];
        }
        return $date;
    }

    public static function appConverter($param)
    {
        if ($param == 'website') {
            $result = 'Website';
        } else if ($param == 'ppid') {
            $result = 'Ppid';
        } else {
            $result = 'Aplikasi Tidak Ditemukan!';
        }

        return $result;
    }

    public static function roleConverter($param)
    {
        if ($param == "superadmin") {
            $result = 'Super Admin';
        } else if ($param == "admin") {
            $result = 'Admin';
        } else {
            $result = 'Rule tidak ditemukan!';
        }

        return $result;
    }

    public static function getRule()
    {
        $rule = Rule::where('user_id', '=', Auth::user()->id)
            ->where('aplikasi', '=', 'website')
            ->first();
        if ($rule)
            return $rule->nama_rule;
    }

    public static function getAplikasi()
    {
        return Rule::where('user_id', '=', Auth::user()->id)
            ->where('aplikasi', '=', 'website')
            ->first()->nama_rule;
    }

    public static function showAplikasi()
    {
        return Rule::where('user_id', '=', Auth::user()->id)->get();
    }
}

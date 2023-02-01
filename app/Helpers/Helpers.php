<?php

namespace App\Helpers;

use App\Models\ContentType;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\PagesType;
use App\Models\PostComment;
use App\Models\SubPages;
use App\Models\User;
use DateTime;
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


    // post function

    public static function GetTypeContent($param)
    {
        $type = ContentType::where('id', '=', $param)->select('name')->first();

        return $type->name;
    }

    public static function GetUser($param)
    {
        $user = User::where('id', '=', $param)->select('nama')->first();

        return $user->nama;
    }

    public static function GetComment($param)
    {
        $comment = PostComment::where('post_id', '=', $param)->get();
        return $comment;
    }

    public static function CountComment($param)
    {
        $comment = PostComment::where('post_id', '=', $param)->get();
        return $comment->count();
    }

    // pages function

    public static function GetTypePage($param)
    {
        $type = PagesType::where('id', '=', $param)->select('name')->first();

        return $type->name;
    }

    // Custom Function

    public static function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public static function GetDate($param)
    {
        $explode    = explode(" ", $param);
        $date       = explode("-", $explode[0]);

        if ($date[1] == '01') {
            $date = 'Jan ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '02') {
            $date = 'Feb ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '03') {
            $date = 'Mar ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '04') {
            $date = 'Apr ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '05') {
            $date = 'Mei ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '06') {
            $date = 'Jun ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '07') {
            $date = 'Jul ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '08') {
            $date = 'Aug ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '09') {
            $date = 'Sep ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '10') {
            $date = 'Oct ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '11') {
            $date = 'Nov ' . $date[2] . ", " . $date[0];
        } elseif ($date[1] == '12') {
            $date = 'Dec ' . $date[2] . ", " . $date[0];
        }
        return $date;
    }

    public static function GetTime($param)
    {
        $explode    = explode(" ", $param);
        $times      = explode(":", $explode[1]);
        $time       = implode(":", $times);

        return date("g:i A", strtotime($time));
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

    public static function getRole()
    {
        $rule = User::where('id', '=', Auth::user()->id)
            ->first();
        if ($rule)
            return $rule->role;
    }
}

<?php

namespace App\Helpers;

use App\Models\Address;
use App\Models\ContentType;
use App\Models\KIP;
use App\Models\Laporan;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\PagesType;
use App\Models\Permohonan;
use App\Models\PostComment;
use App\Models\Posts;
use App\Models\Recent;
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
        return SubPages::where('sub_pages_id', '=', $param)->select('sub_pages.title', 'sub_pages.id as sub_menu_id', 'sub_pages.jenis_link', 'sub_pages.link')->get();
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

    ### DATA FUNCTION ###

    public static function __address()
    {
        return Address::get()->last();
    }

    // Custom Function

    public static function __phone($param)
    {
        $phone = ltrim($param, '0');
        $phone1 = substr($phone, 0, 3);
        $phone2 = substr($phone, 3, 4);
        $phone3 = substr($phone, 7, 4);
        return '(+62) ' . $phone1 . '-' . $phone2 . '-' . $phone3;
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

    public static function RangeTime($param)
    {
        $param3 = date_diff(new DateTime($param), new DateTime());

        if ($param3->i == 0) {
            $param4 = $param3->s . 's ago';
            return $param4;
        } elseif ($param3->h == 0) {
            $param4 = $param3->i . 'min ago';
            return $param4;
        } elseif ($param3->days == 0) {
            $param4 = $param3->h . 'h ago';
            return $param4;
        } elseif ($param3->m == 0) {
            $param4 = $param3->d . 'd ago';
            return $param4;
        } elseif ($param3->y == 0) {
            $param4 = $param3->m . 'm ago';
            return $param4;
        } elseif ($param3->y != 0) {
            $param4 = $param3->y . 'y ago';
            return $param4;
        } else {
            $param4 = 0;
            return $param4;
        }
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

    public static function _getLaporan()
    {
        return Laporan::where('jawaban', '=', NULL)->limit(4)->get();
    }

    public static function _getPermohonan()
    {
        return Permohonan::where('status', 'proses')->limit(4)->get();
    }

    public static function _reportYearsPost($param)
    {
        $data = array();

        $count1 = Posts::where('created_at', 'LIKE', $param.'%')->count();
        array_push($data, $count1);
        $count2 = Posts::where('created_at', 'LIKE', ($param-1).'%')->count();
        array_push($data, $count2);
        $count3 = Posts::where('created_at', 'LIKE', ($param-2).'%')->count();
        array_push($data, $count3);
        $count4 = Posts::where('created_at', 'LIKE', ($param-3).'%')->count();
        array_push($data, $count4);
        $count5 = Posts::where('created_at', 'LIKE', ($param-4).'%')->count();
        array_push($data, $count5);

        return $data;
    }

    public static function _reportYearsLaporan($param)
    {
        $data = array();

        $count1 = Laporan::where('created_at', 'LIKE', $param.'%')->count();
        array_push($data, $count1);
        $count2 = Laporan::where('created_at', 'LIKE', ($param-1).'%')->count();
        array_push($data, $count2);
        $count3 = Laporan::where('created_at', 'LIKE', ($param-2).'%')->count();
        array_push($data, $count3);
        $count4 = Laporan::where('created_at', 'LIKE', ($param-3).'%')->count();
        array_push($data, $count4);
        $count5 = Laporan::where('created_at', 'LIKE', ($param-4).'%')->count();
        array_push($data, $count5);

        return $data;
    }

    public static function _reportYearsPermohonan($param)
    {
        $data = array();

        $count1 = Permohonan::where('created_at', 'LIKE', $param.'%')->count();
        array_push($data, $count1);
        $count2 = Permohonan::where('created_at', 'LIKE', ($param-1).'%')->count();
        array_push($data, $count2);
        $count3 = Permohonan::where('created_at', 'LIKE', ($param-2).'%')->count();
        array_push($data, $count3);
        $count4 = Permohonan::where('created_at', 'LIKE', ($param-3).'%')->count();
        array_push($data, $count4);
        $count5 = Permohonan::where('created_at', 'LIKE', ($param-4).'%')->count();
        array_push($data, $count5);

        return $data;
    }

    public static function _recentAdd($param1, $param2, $param3)
    {
        Recent::create([
            'user_id' => Auth::user()->id,
            'uuid_activity' => $param1,
            'activity' => $param2,
            'jenis' => $param3
        ]);
    }

    public static function _KipPPID($param)
    {
        $KIP = KIP::where('jenis_informasi', '=', $param)->get();

        $data = [
            'tahun' => array(),
            'data' => array()
        ];
        $tahun = [];

        foreach($KIP as $k => $val) {
            if (!isset($tahun[$val->created_at])) {
                $tahun[$val->created_at] = [];
            }
        }
        $c_sort = count($tahun);
        $i = 0;
        if (is_array($tahun) && ($c_sort > 0)) {
            foreach ($tahun as $k => $v) {
                array_push($data['tahun'], $k);
                $data['data'][$k] = array(
                    'tahun' => $k,
                    'kip' => array()
                );
            }
            foreach ($KIP as $key => $val) {
                
            }
        }
    }
}

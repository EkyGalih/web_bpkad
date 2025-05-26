<?php

use App\Enum\KlasifikasiEnum;
use App\Models\Address;
use App\Models\Apps;
use App\Models\Assets;
use App\Models\Bender;
use App\Models\Bidang;
use App\Models\ContentType;
use App\Models\Galery;
use App\Models\KIP;
use App\Models\Laporan;
use App\Models\Links;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\PagesType;
use App\Models\Pegawai;
use App\Models\Permohonan;
use App\Models\PostComment;
use App\Models\Posts;
use App\Models\PowerPoint;
use App\Models\PPIDStruktur;
use App\Models\Recent;
use App\Models\Slideitem;
use App\Models\Social;
use App\Models\SubPages;
use App\Models\User;
use App\Models\LokasiAset;
use App\Models\PostsCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

### post function ###

if (!function_exists('GetCategoryContent')) {
    function GetCategoryContent($param)
    {
        $type = PostsCategory::where('id', '=', $param)->select('category')->first();

        return $type->category;
    }
}

if (!function_exists('GetTypeContent')) {
    function GetTypeContent($param)
    {
        $type = ContentType::where('id', '=', $param)->select('name')->first();

        return $type->name;
    }
}

if (!function_exists('GetUser')) {
    function GetUser($param)
    {
        $user = User::where('id', '=', $param)->select('nama')->first();

        return $user->nama;
    }
}

if (!function_exists('PostCategory')) {
    function PostCategory($id)
    {
        $cat = PostsCategory::where('id', '=', $id)
            ->select('category')
            ->first();
        return $cat->category ?? '-';
    }
}

if (!function_exists('Tags')) {
    function Tags($tags)
    {
        $explode = explode(",", $tags);
        return $explode;
    }
}

if (!function_exists('getPostCategory')) {
    function getPostCategory()
    {
        return Posts::join('posts_category', 'posts.posts_category_id', '=', 'posts_category.id')
            ->groupBy('posts_category.category')
            ->select('posts_category.category', 'posts_category.id')
            ->get();
    }
}

if (!function_exists('countCategoryPost')) {
    function countCategoryPost($cat)
    {
        return Posts::where('posts_category_id', '=', $cat)
            ->count();
    }
}

if (!function_exists('getPostTag')) {
    function getPostTag($tags, $cat)
    {
        return Posts::where('tags', 'LIKE', '%' . $tags . '%')
            ->where('posts_category_id', '=', $cat)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
    }
}

if (!function_exists('countTag')) {
    function countTag()
    {
        $posts = Posts::select('tags')->groupBy('tags')->limit('14')->orderBy('created_at', 'DESC')->get();
        $tags = array();
        foreach ($posts as $post) {
            if ($post->tags != null) {
                $exp = explode(",", $post->tags);
                foreach ($exp as $item) {
                    array_push($tags, $item);
                }
            }
        }

        return $tags;
    }
}

// pages function

if (!function_exists('GetTypePage')) {
    function GetTypePage($param)
    {
        $type = PagesType::where('id', '=', $param)->select('name')->first();

        return $type->name;
    }
}

### DATA FUNCTION ###


// Custom Function
if (!function_exists('randomColor')) {
    function randomColor()
    {
        $chars = 'ABCDEF0123456789';
        $color = '#';
        for ($i = 0; $i < 6; $i++) {
            $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }
}

if (!function_exists('randomString')) {
    function randomString($panjang)
    {
        $karakter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($karakter);
        $random_string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $random_character = $karakter[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
}

if (!function_exists('_jsonDecode')) {
    function _jsonDecode($param)
    {
        $files = file_get_contents($param);
        $data = json_decode($files, true);
        return $data;
    }
}

if (!function_exists('GetDate')) {
    function GetDate($param)
    {
        if ($param == NULL) {
            return "-";
        } else {
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
    }
}

if (!function_exists('_GetYears')) {
    function _GetYears()
    {
        $years = [];

        // Tambahkan tahun depan terlebih dahulu
        array_push($years, date('Y') + 1);

        // Tambahkan 10 tahun sebelumnya
        for ($i = 0; $i < 10; $i++) {
            $year = date('Y') - $i;
            array_push($years, $year);
        }

        return $years;
    }
}

if (!function_exists('GetTime')) {
    function GetTime($param)
    {
        if ($param == NULL) {
            return "-";
        } else {
            $explode    = explode(" ", $param);
            $times      = explode(":", $explode[1]);
            $time       = implode(":", $times);

            return date("g:i A", strtotime($time));
        }
    }
}

if (!function_exists('NameMonth')) {
    function NameMonth($param)
    {
        switch ($param) {
            case '01':
                $month = 'Januari';
                break;
            case '02':
                $month = 'Februari';
                break;
            case '03':
                $month = 'Maret';
                break;
            case '04':
                $month = 'April';
                break;
            case '05':
                $month = 'Mei';
                break;
            case '06':
                $month = 'Juni';
                break;
            case '07':
                $month = 'Juli';
                break;
            case '08':
                $month = 'Agustus';
                break;
            case '09':
                $month = 'September';
                break;
            case '10':
                $month = 'Oktober';
                break;
            case '11':
                $month = 'November';
                break;
            case '11':
                $month = 'Desember';
                break;
            default:
                $month = '';
        }

        return $month;
    }
}

if (!function_exists('NewData')) {
    function NewData($date)
    {
        $exp_date = explode(' ', $date);
        $new_date = date('Y-m-d');

        if ($exp_date[0] == $new_date) {
            $data = 'true';
        } else {
            $data = 'false';
        }

        return $data;
    }
}

if (!function_exists('RangeTime')) {
    function RangeTime($param)
    {
        $param3 = date_diff(new DateTime($param), new DateTime());

        if ($param3->i == 0) {
            $param4 = $param3->s . 'detik lalu';
            return $param4;
        } elseif ($param3->h == 0) {
            $param4 = $param3->i . 'menit lalu';
            return $param4;
        } elseif ($param3->days == 0) {
            $param4 = $param3->h . 'jam lalu';
            return $param4;
        } elseif ($param3->m == 0) {
            $param4 = $param3->d . 'hari lalu';
            return $param4;
        } elseif ($param3->y == 0) {
            $param4 = $param3->m . 'bulan lalu';
            return $param4;
        } elseif ($param3->y != 0) {
            $param4 = $param3->y . 'tahun lalu';
            return $param4;
        } else {
            $param4 = 0;
            return $param4;
        }
    }
}

if (!function_exists('appConverter')) {
    function appConverter($param)
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
}

if (!function_exists('roleConverter')) {
    function roleConverter($param)
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
}

if (!function_exists('getRole')) {
    function getRole()
    {
        $rule = User::where('id', '=', Auth::user()->id)
            ->first();
        if ($rule)
            return $rule->role;
    }
}

if (!function_exists('_getLaporan')) {
    function _getLaporan()
    {
        return Laporan::where('jawaban', '=', NULL)->limit(4)->get();
    }
}

if (!function_exists('_getPermohonan')) {
    function _getPermohonan()
    {
        return Permohonan::where('status', 'proses')
            ->limit(4)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}

if (!function_exists('_PostMonth')) {
    function _PostMonth($param)
    {
        $data       = array();
        $explode    = explode("-", $param);
        $month1     = $explode[1] - 1;
        $month2     = $explode[1] - 2;
        if (strlen($month1) == 1) {
            $query1 = $explode[0] . '-0' . $month1;
        } elseif (strlen($month1) > 1) {
            $query1 = $explode[0] . '-' . $month1;
        }
        if (strlen($month2) == 1) {
            $query2 = $explode[0] . '-0' . $month2;
        } elseif (strlen($month2) > 1) {
            $query2 = $explode[0] . '-' . $month2;
        }

        $count1 = Posts::where('created_at', 'LIKE', $param . '%')->count();
        array_push($data, $count1);
        $count2 = Posts::where('created_at', 'LIKE', $query1 . '%')->count();
        array_push($data, $count2);
        $count3 = Posts::where('created_at', 'LIKE', $query2 . '%')->count();
        array_push($data, $count3);

        return $data;
    }
}

if (!function_exists('_recentAdd')) {
    function _recentAdd($param1, $param2, $param3)
    {

        Recent::create([
            'user_id' => Auth::user()->id,
            'uuid_activity' => $param1,
            'activity' => $param2,
            'jenis' => $param3
        ]);
    }
}

// data pns
if (!function_exists('NIP')) {
    function NIP($param)
    {
        if (strlen($param) != 18) {
            return '0';
        }

        // Memecah NIP berdasarkan komponen
        $tanggalLahir = substr($param, 0, 8);
        $pengangkatan = substr($param, 8, 6);
        $jenisKelamin = substr($param, 14, 1);
        $nomorUrut = substr($param, 15, 3);

        $nip = $tanggalLahir . ' ' . $pengangkatan . ' ' . $jenisKelamin . ' ' . $nomorUrut;
        return $nip;
    }
}

if (!function_exists('hitungMasaKerja')) {
    function hitungMasaKerja($param)
    {
        $tanggalSk = Carbon::parse($param);
        $sekarang = Carbon::now();

        $tahun = $sekarang->diffInYears($tanggalSk);
        $bulan = $sekarang->diffInMonths($tanggalSk) % 12;
        $hari = $sekarang->diffInDays($tanggalSk->addYears($tahun)->addMonths($bulan));

        $mkg = $tahun . ' Tahun ' . $bulan . ' Bulan ' . $hari . ' Hari';
        return $mkg;
    }
}

if (!function_exists('progressBarPangkat')) {
    function progressBarPangkat($param)
    {
        $tanggalKenaikan = Carbon::create($param);

        $tanggalSekarang = Carbon::now();

        $totalHari = $tanggalSekarang->diffInDays($tanggalKenaikan);

        $totalHariDalamTahun = $tanggalSekarang->isLeapYear() ? 366 : 365;

        $persentase = round(($totalHari / $totalHariDalamTahun) * 100);
        if ($persentase > 100) {
            $persentase = 100;
        }
        return $persentase;
    }
}

if (!function_exists('USIA')) {
    function USIA($param)
    {
        $tanggalLahir = \Carbon\Carbon::createFromFormat('Y-m-d', $param);

        $sekarang = \Carbon\Carbon::now();

        $umurTahun = $tanggalLahir->diffInYears($sekarang);

        $tanggalUlangTahunTerakhir = $tanggalLahir->addYears($umurTahun);
        $hariBerlalu = $tanggalUlangTahunTerakhir->diffInDays($sekarang);

        $result = new stdClass();
        $result->umur = $umurTahun;
        $result->hari = $hariBerlalu;

        return $result;
    }
}

if (!function_exists('_recentShow')) {
    function _recentShow($jenis, $uuid)
    {
        switch ($jenis) {
            case 'post':
                $data = Posts::where('id', '=', $uuid)->select('title as nama')->first();
                break;
            case 'pages':
                $data = Pages::where('id', '=', $uuid)->select('title as nama')->first();
                break;
            case 'sub_pages':
                $data = SubPages::where('id', '=', $uuid)->select('title as nama')->first();
                break;
            case 'assets':
                $data = Assets::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            case 'transparansi':
                $data = User::where('id', '=', $uuid)->select('nama')->first();
                break;
            case 'kip':
                $data = KIP::where('id', '=', $uuid)->select('nama_informasi as nama')->first();
                break;
            case 'galery':
                $data = Galery::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            case 'slider':
                $data = Slideitem::where('id', '=', $uuid)->select('title as nama')->first();
                break;
            case 'powerpoint':
                $data = PowerPoint::where('id', '=', $uuid)->select('element as nama')->first();
                break;
            case 'bender':
                $data = Bender::where('id', '=', $uuid)->select('url as nama')->first();
                break;
            case 'menu':
                $data = Menu::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            case 'social':
                $data = Social::where('id', '=', $uuid)->select('whatsapp', 'twitter', 'facebook', 'instagram', 'youtube')->first();
                break;
            case 'link':
                $data = Links::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            case 'address':
                $data = Address::where('id', '=', $uuid)->select('address as nama')->first();
                break;
            case 'apps':
                $data = Apps::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            case 'laporan':
                $data = Laporan::where('id', '=', $uuid)->select('judul_laporan as nama')->first();
                break;
            case 'permohonan':
                $data = Permohonan::where('id', '=', $uuid)->select('kode_pemohon as nama')->first();
                break;
            case 'users':
                $data = User::where('id', '=', $uuid)->select('nama')->first();
                break;
            case 'ppid_struktur':
                $data = PPIDStruktur::where('id', '=', $uuid)->select('nama_jabatan as nama')->first();
                break;
            case 'pegawai':
                $data = Pegawai::where('id', '=', $uuid)->select('name as nama')->first();
                break;
            default:
                $data = '';
        }

        return $data->nama ?? '';
    }
}

if (!function_exists('createSlug')) {
    function createSlug($title, $model)
    {
        // Generate initial slug
        $slug = Str::slug($title);

        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $counter = 1;

        while ($model::where('slug', $slug)->exists()) {
            // If the slug exists, add the counter to the end
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

// hitung aset terdistribusi
if (!function_exists('countAsetDistribusi')) {
    function countAsetDistribusi($param)
    {
        return LokasiAset::where('aset_id', '=', $param)->count();
    }
}

if (!function_exists('GetAllBidang')) {
    function GetAllBidang()
    {
        return Bidang::select('id as bidang_id', 'bidang.*')->orderBy('nama_bidang', 'asc')->get();
    }
}

if (!function_exists('GetBidang')) {
    function GetBidang($param)
    {
        return Bidang::where('id', $param)->value('nama_bidang');
    }
}

### Function For Menu ###

if (!function_exists('Menu')) {
    function Menu()
    {
        return Menu::select('menu.id as menu_id', 'menu.*')
            ->orderBy('order_pos', 'ASC')
            ->get();
    }
}

if (!function_exists('Pages')) {
    function Pages($param)
    {
        return Pages::where('menu_id', '=', $param)
            ->select('pages.title', 'pages.slug', 'pages.id as sub_menu_id', 'pages.jenis_link', 'pages.link')
            ->where('deleted_at', '=', NULL)
            ->orderBy('title', 'ASC')
            ->get();
    }
}

if (!function_exists('SubPages')) {
    function SubPages($param)
    {
        return SubPages::where('sub_pages_id', '=', $param)
            ->select('sub_pages.title', 'sub_pages.slug', 'sub_pages.id as sub_menu_id', 'sub_pages.jenis_link', 'sub_pages.link')
            ->where('deleted_at', '=', NULL)
            ->orderBy('title', 'ASC')
            ->get();
    }
}
### END Function For Menu ###

if (!function_exists('get_klasifikasi_enum')) {
    function get_klasifikasi_enum(string $input): ?KlasifikasiEnum
    {
        $normalized = str_replace('_', ' ', strtolower($input));
        return KlasifikasiEnum::tryFrom($normalized);
    }
}

### Pegawai Function ###

if (!function_exists('get_pimpinan')) {
    function get_pimpinan($cat, $param)
    {
        if ($cat == 'select') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->first();
        } elseif ($cat == 'count') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->count();
        }

        return null;
    }
}

if (!function_exists('get_pegawai')) {
    function get_pegawai($cat, $act, $param, $param2)
    {
        if ($cat == 'select') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->where('jabatan', 'LIKE', '%' . $param2 . '%')
                ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                ->get();
        } elseif ($cat == 'count') {
            if ($act == 'not') {
                return Pegawai::where('nama_jabatan', '=', $param)
                    ->where('jabatan', 'NOT LIKE', '%' . $param2 . '%')
                    ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                    ->count();
            } elseif ($act == 'like') {
                return Pegawai::where('nama_jabatan', '=', $param)
                    ->where('jabatan', 'LIKE', '%' . $param2 . '%')
                    ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                    ->count();
            }
        }
    }
}

if (!function_exists('get_pegawais')) {
    function get_pegawais($param, $act)
    {
        if ($act == 'pendidikan') {
            return Pegawai::where('pendidikan', 'LIKE', '%' . $param . '%')->count();
        } elseif ($act == 'golongan') {
            return Pegawai::join('pangkat', 'pegawai.pangkat_id', '=', 'pangkat.id')
                ->where('nama_pangkat', 'LIKE', $param . '%')
                ->count();
        }
    }
}

if (!function_exists('get_pegawai_kontrak')) {
    function get_pegawai_kontrak($param)
    {
        if ($param == 'count') {
            return Pegawai::where('pangkat_id', '=', NULL)->count();
        }
    }
}

if (!function_exists('getKabag')) {
    function getKabag($cat, $param, $param2)
    {
        if ($cat == 'select') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->orWhere('nama_jabatan', '=', $param2)
                ->select('name', 'jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->get();
        } elseif ($cat == 'count') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->orWhere('nama_jabatan', '=', $param2)
                ->select('name', 'jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->count();
        }
    }
}

if (!function_exists('getKasubag')) {
    function getKasubag($cat, $param, $param2)
    {
        if ($cat == 'select') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->where('initial_jabatan', 'LIKE', $param2 . '%')
                ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->get();
        } elseif ($cat == 'count') {
            return Pegawai::where('nama_jabatan', '=', $param)
                ->where('initial_jabatan', 'LIKE', $param2 . '%')
                ->select('name', 'initial_jabatan', 'nama_jabatan', 'foto')
                ->where('status_pegawai', '=', 'aktif')
                ->count();
        }
    }
}

if (!function_exists('getPejabatPPID')) {
    function getPejabatPPID($jabatan)
    {
        return PPIDStruktur::join('pegawai', 'ppid_struktur.pegawai_id', '=', 'pegawai.id')
            ->where('ppid_struktur.jabatan', '=', $jabatan)
            ->where('ppid_struktur.deleted_at', '=', NULL)
            ->select('ppid_struktur.jabatan', 'ppid_struktur.nama_jabatan', 'pegawai.name', 'pegawai.foto', 'pegawai.jenis_kelamin')
            ->first();
    }
}

if (!function_exists('getAnggotaPPID')) {
    function getAnggotaPPID($jabatan)
    {
        return PPIDStruktur::join('pegawai', 'ppid_struktur.pegawai_id', '=', 'pegawai.id')
            ->where('ppid_struktur.jabatan', '=', $jabatan)
            ->where('ppid_struktur.deleted_at', '=', NULL)
            ->select('ppid_struktur.jabatan', 'ppid_struktur.nama_jabatan', 'pegawai.name', 'pegawai.foto')
            ->get();
    }
}

### END PEGAWAI FUNCTION ###

## DATA FUNCTION ###
if (!function_exists('__address')) {
    function __address()
    {
        return Address::get()->last();
    }
}

if (!function_exists('__phone')) {
    function __phone($param)
    {
        $phone = ltrim($param, '0');
        $phone1 = substr($phone, 0, 3);
        $phone2 = substr($phone, 3, 4);
        $phone3 = substr($phone, 7, 4);
        return '(+62) ' . $phone1 . '-' . $phone2 . '-' . $phone3;
    }
}
## END DATA FUNCTION ###
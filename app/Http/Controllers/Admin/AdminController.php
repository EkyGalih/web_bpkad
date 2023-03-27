<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Permohonan;
use App\Models\Posts;
use DateTime;

class AdminController extends Controller
{
    public function index()
    {
        $post = Posts::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $laporan = Laporan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $permohonan = Permohonan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $posts = Posts::orderBy('created_at', 'DESC')->limit(5)->get();
        $lap = Laporan::where('jawaban', '!=', NULL)->where('created_at', 'LIKE' . date('Y-m') . '%')->limit(5)->get();

        // post 5 tahun terakhir
        

        return view('admin.beranda.beranda', compact('post', 'laporan', 'permohonan', 'posts', 'lap'));
    }

    public function _NotFound()
    {
        return view('admin.not_found');
    }
}

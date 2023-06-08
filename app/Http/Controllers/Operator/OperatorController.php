<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Permohonan;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{
    public function index()
    {
        $post = Posts::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $laporan = Laporan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $permohonan = Permohonan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $posts = Posts::orderBy('created_at', 'DESC')->limit(5)->get();
        $lap = Laporan::where('jawaban', '!=', NULL)->where('created_at', 'LIKE' . date('Y-m') . '%')->limit(5)->get();
        $recents = DB::table('recent_activity')
            ->where('recent_activity.created_at', 'LIKE', date('Y-m-d') . '%')
            ->where('recent_activity.user_id', '=', Auth::user()->id)
            ->orderBy('recent_activity.created_at', 'DESC')
            ->limit(7)
            ->get();

        return view('operator.beranda.beranda', compact('post', 'laporan', 'permohonan', 'posts', 'lap', 'recents'));
    }

    public function _NotFound()
    {
        return view('operator.not_found');
    }
}

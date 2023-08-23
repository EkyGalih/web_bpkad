<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\Olympic;
use App\Models\Permohonan;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $post = Posts::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $laporan = Laporan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $permohonan = Permohonan::where('created_at', 'LIKE', date('Y-m') . '%')->count();
        $posts = Posts::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->limit(5)->get();
        $lap = Laporan::where('jawaban', '!=', NULL)->where('created_at', 'LIKE' . date('Y-m') . '%')->limit(5)->get();
        $recents = DB::table('recent_activity')
            ->where('recent_activity.created_at', 'LIKE', date('Y-m-d') . '%')
            ->where('recent_activity.user_id', '=', Auth::user()->id)
            ->orderBy('recent_activity.created_at', 'DESC')
            ->limit(7)
            ->get();

        return view('admin.beranda.beranda', compact('post', 'laporan', 'permohonan', 'posts', 'lap', 'recents'));
    }

    public function olympic($id = null)
    {
        $bidangs = Bidang::get();
        $olympics = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.uuid')
            ->orderBy('emas', 'DESC')
            ->orderBy('total', 'DESC')
            ->select(
                'bidang.nama_bidang',
                'olympic.*'
            )
            ->get();
        if ($id == null) {
            $olympic = "";
        } elseif ($id != null) {
            $olympic = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.uuid')
                ->orderBy('emas', 'DESC')
                ->orderBy('total', 'DESC')
                ->select(
                    'bidang.uuid',
                    'bidang.nama_bidang',
                    'olympic.*'
                )
                ->where('olympic.id', '=', $id)
                ->first();
        }

        return view('admin.tools.olympic.index', compact('bidangs', 'olympics', 'olympic'));
    }

    public function store(Request $request)
    {
        $cek_bidang = Olympic::where('bidang_id', '=', $request->bidang_id)->first();
        // dd($cek_bidang);
        if ($cek_bidang == NULL) {
            Olympic::create([
                'bidang_id' => $request->bidang_id,
                'emas' => $request->emas,
                'perak' => $request->perak,
                'perunggu' => $request->perunggu,
                'total' => $request->emas + $request->perak + $request->perunggu
            ]);
        } else {
            $emas = $cek_bidang->emas + $request->emas;
            $perak = $cek_bidang->perak + $request->perak;
            $perunggu = $cek_bidang->perunggu + $request->perunggu;
            $total_temp = $request->emas + $request->perak + $request->perunggu;
            $total = $cek_bidang->total + $total_temp;

            $cek_bidang->update([
                'emas' => $emas,
                'perak' => $perak,
                'perunggu' => $perunggu,
                'total' => $total
            ]);
        }

        return redirect()->back()->with(['success' => 'Data diupdate!']);
    }

    public function update(Request $request, $id)
    {
        $olympic = Olympic::findOrFail($id);

        $emas = $request->emas;
        $perak = $request->perak;
        $perunggu =$request->perunggu;
        $total = $emas + $perak + $perunggu;

        $olympic->update([
            'emas' => $emas,
            'perak' => $perak,
            'perunggu' => $perunggu,
            'total' => $total
        ]);

        return redirect()->route('olympic-admin.index')->with(['success' => 'Data berhasil diupdate!']);
    }
}

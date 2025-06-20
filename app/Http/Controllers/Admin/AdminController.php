<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\Olympic;
use App\Models\Pages;
use App\Models\Permohonan;
use App\Models\Posts;
use App\Models\SubPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function olympic(Request $request)
    {
        $bidangs = Bidang::get();
        $year = $request->query('tahun') ?? Olympic::select('tahun')->orderByDesc('tahun')->first()?->tahun;
        $season = Olympic::select('keterangan')->where('tahun', $year)->first()?->keterangan ?? 'Olimpiade';

        $olympics = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.id')
            ->where('olympic.tahun', $year)
            ->orderByDesc('emas')
            ->orderByDesc('perak')
            ->orderByDesc('perunggu')
            ->select(
                'bidang.nama_bidang',
                'olympic.*'
            )
            ->get();

        $previousYear = $year ?? now()->year - 1;

        $before_winners = Olympic::where('tahun', $previousYear)
            ->orderByDesc('emas')   // Jika total sama, lihat emas
            ->orderByDesc('perak')  // Jika emas sama, lihat perak
            ->orderByDesc('perunggu') // Jika perak juga sama, lihat perunggu
            ->take(3)
            ->get()
            ->map(function ($item, $index) {
                $item->ranking = $index + 1;
                return $item;
            });



        $years = Olympic::select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get()
            ->pluck('tahun');

        return view('admin.Tools.olympic.index', compact('bidangs', 'olympics', 'years', 'year', 'before_winners', 'season'));
    }

    public function create_periode(Request $request)
    {
        $tahun = now()->year;

        // Cek apakah sudah ada data Olympic untuk tahun ini
        $exists = Olympic::where('tahun', $tahun)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Periode untuk tahun ini sudah ada!');
        }

        $bidangs = Bidang::selectRaw('MIN(id) as id, nama_bidang')
            ->whereNotIn('nama_bidang', ['Pimpinan', 'Lainnya'])
            ->groupBy('nama_bidang')
            ->get();

        foreach ($bidangs as $bidang) {
            $olympic = new Olympic();
            $olympic->bidang_id = $bidang->id;
            $olympic->emas = 0;
            $olympic->perak = 0;
            $olympic->perunggu = 0;
            $olympic->total = 0;
            $olympic->tahun = $tahun;
            $olympic->keterangan = $request->name;
            $olympic->save();
        }

        _recentAdd($olympic->id, ' Membuat periode baru untuk Olimpiade', 'olympic');

        return redirect()->back()->with('success', 'Periode berhasil dibuat!');
    }

    public function store(Request $request)
    {
        $olympic = Olympic::findOrFail($request->id);
        $field = $request->field;
        $value = (int) $request->value;

        // Validasi field yang diizinkan
        if (!in_array($field, ['emas', 'perak', 'perunggu'])) {
            return response()->json(['error' => 'Invalid field'], 400);
        }

        $olympic->$field = $value;
        $olympic->total = $olympic->emas + $olympic->perak + $olympic->perunggu;
        $olympic->save();

        return response()->json(['success' => true, 'total' => $olympic->total]);
    }

    public function update(Request $request, $id)
    {
        $olympic = Olympic::findOrFail($id);

        $emas = $request->emas;
        $perak = $request->perak;
        $perunggu = $request->perunggu;
        $total = $emas + $perak + $perunggu;

        $olympic->update([
            'emas' => $emas,
            'perak' => $perak,
            'perunggu' => $perunggu,
            'total' => $total
        ]);

        return redirect()->route('olympic-admin.index')->with(['success' => 'Data berhasil diupdate!']);
    }

    public function checkSlugPage(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        $originalSlug = $slug;
        $counter = 1;

        while (Pages::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }

    public function checkSlugSubPage(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        $originalSlug = $slug;
        $counter = 1;

        while (SubPages::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }
}

<?php

namespace App\Http\Controllers\Simpeg\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang = Bidang::orderByDesc('updated_at')->get()->unique('nama_bidang')->values();

        return view('SimPeg.bidang.bidang', compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required'
        ]);
        config(['database.default' => 'simpeg']);
        Bidang::create([
            'nama_bidang' => $request->nama_bidang
        ]);

        return redirect()->route('bidang.index')->with(['success' => 'Data Bidang Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('pages.simpeg.admin.bidang.show', compact('bidang'));
    }

    public function getPegawai($id)
    {
        $nama_bidang = Bidang::where('id', $id)->value('nama_bidang');

        // Ambil semua ID dari bidang yang punya nama_bidang sama
        $bidang_ids = Bidang::where('nama_bidang', $nama_bidang)->pluck('id');

        // Ambil semua pegawai yang bidang_id-nya termasuk salah satu dari ID di atas
        $pegawai = Pegawai::whereIn('bidang_id', $bidang_ids)
            ->where('status_pegawai', 'aktif')
            ->whereNull('deleted_at')
            ->paginate(6);

        return view('SimPeg.bidang.getPegawai', compact('pegawai', 'nama_bidang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        config(['database.default' => 'simpeg']);
        $bidang = Bidang::findOrFail($id);
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->save();

        return redirect()->route('bidang.index')->with(['success' => 'Data Bidang Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('simpeg.admin.bidang.index')->with(['success' => 'Data Bidang Berhasil Dihapus']);
    }
}

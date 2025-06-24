<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PPIDStruktur;
use DateTime;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $struktural = PPIDStruktur::with('pegawai')->whereNull('deleted_at')->get();

        return view('admin.ppid.struktural.index', compact('struktural'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawais = Pegawai::get();
        $jabatan = _jsonDecode('server/data/ppid/jabatan.json');

        return view('admin.ppid.struktural.components.create', compact('pegawais', 'jabatan'));
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
            'pegawai_id' => 'required',
            'jabatan' => 'required',
            'nama_jabatan' => 'required'
        ]);

        $exists = PPIDStruktur::where('jabatan', $request->jabatan)->first();

        if ($exists) {
            $exists->update([
                'pegawai_id' => $request->pegawai_id
            ]);
            _recentAdd($exists->id, 'menambahkan pejabat ppid baru', 'ppid_struktur');
        } else {
            $ppid = new PPIDStruktur();
            $ppid->id = (string) Uuid::generate(4);
            $ppid->pegawai_id = $request->pegawai_id;
            $ppid->jabatan = $request->jabatan;
            $ppid->nama_jabatan = $request->nama_jabatan;
            $ppid->save();
            _recentAdd($ppid->id, 'menambahkan pejabat ppid', 'ppid_struktur');
        }

        return redirect()->route('struktur-organisasi.index')->with(['success' => 'Pejabat berhasil ditambah!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PPIDStruktur $ppid)
    {
        $struktur = $ppid;
        $pegawais = Pegawai::get();
        $jabatan = _jsonDecode('server/data/ppid/jabatan.json');

        return view('admin.ppid.struktural.components.edit', compact('pegawais', 'struktur', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PPIDStruktur $ppid)
    {
        // Update the ppid structure
        $ppid->nama_jabatan = $request->nama_jabatan;
        $ppid->jabatan = $request->jabatan;
        $ppid->pegawai_id = $request->pegawai_id;
        $ppid->save();

        _recentAdd($ppid->id, 'mengubah pejabat ppid', 'ppid_struktur');

        return redirect()->route('struktur-organisasi.index')->with(['success' => 'Pejabat berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PPIDStruktur $ppid)
    {
        $ppid->update([
            'deleted_at' => new DateTime()
        ]);

        _recentAdd($ppid->id, 'menghapus pejabat ppid', 'ppid_struktur');

        return redirect()->route('struktur-organisasi.index')->with(['success' => 'Pejabat berhasil dihapus!']);
    }
}

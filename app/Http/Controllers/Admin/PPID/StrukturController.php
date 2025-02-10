<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Helpers\Helpers;
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
        $struktural = PPIDStruktur::join('pegawai', 'ppid_struktur.pegawai_id', '=', 'pegawai.id')
            ->select('pegawai.id as uuid', 'pegawai.*', 'ppid_struktur.id as ppid_id', 'ppid_struktur.*')
            ->where('ppid_struktur.deleted_at', '=', NULL)
            ->get();

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
        $jabatan = Helpers::_jsonDecode(asset('server/data/ppid/jabatan.json'));

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
        $id = (string)Uuid::generate(4);

        PPIDStruktur::create([
            'id' => $id,
            'pegawai_id' => $request->pegawai_id,
            'jabatan' => $request->jabatan,
            'nama_jabatan' => $request->nama_jabatan
        ]);

        Helpers::_recentAdd($id, 'menambahkan pejabat ppid', 'ppid_struktur');

        return redirect()->route('ppid-struktur.index')->with(['success' => 'Pejabat berhasil ditambah!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $struktur = PPIDStruktur::findOrFail($id);
        $pegawais = Pegawai::get();
        $jabatan = Helpers::_jsonDecode(asset('server/data/ppid/jabatan.json'));

        return view('admin.ppid.struktural.components.edit', compact('pegawais', 'struktur', 'jabatan'));
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
        $struktural = PPIDStruktur::findOrFail($id);

        $struktural->update([
            'pegawai_id' => $request->pegawai_id,
            'jabatan' => $request->jabatan,
            'nama_jabatan' => $request->nama_jabatan
        ]);

        Helpers::_recentAdd($id, 'mengubah pejabat ppid', 'ppid_struktur');

        return redirect()->route('ppid-struktur.index')->with(['success' => 'Pejabat berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $struktural = PPIDStruktur::findOrFail($id);
        $struktural->update([
            'deleted_at' => new DateTime()
        ]);

        Helpers::_recentAdd($id, 'menghapus pejabat ppid', 'ppid_struktur');

        return redirect()->route('ppid-struktur.index')->with(['success' => 'Pejabat berhasil dihapus!']);
    }
}

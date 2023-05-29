<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PPIDStruktur;
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
        return view('admin.ppid.struktural.create', compact('pegawais'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Golongan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use DateTime;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->paginate(12);

        return view('admin/pegawai/index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = Bidang::get();
        $pangkat = Pangkat::get();
        $golongan = Golongan::get();
        $NamaJabatan = Helpers::_jsonDecode(asset('server/data/umum/NamaJabatan.json'));
        $InitialJabatan = Helpers::_jsonDecode(asset('server/data/umum/InitialJabatan.json'));

        return view('admin.pegawai.components.add', compact('bidang', 'pangkat', 'golongan', 'NamaJabatan', 'InitialJabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $pegawai = Pegawai::findOrFail($id);
        // unlink(asset($pegawai->foto);
        $pegawai->update([
            'deleted_at' => new DateTime()
        ]);

        Helpers::_recentAdd($id, 'menghapus pegawai', 'pegawai');

        return redirect()->route('admin-pegawai.index')->with(['success' => 'Pegawai Berhasil dihapus!']);
    }
}

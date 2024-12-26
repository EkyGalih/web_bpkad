<?php

namespace App\Http\Controllers\Admin\IkuRealisasi;

use App\Http\Controllers\Controller;
use App\Models\IkuRealisasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IkuRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('id as user_id')->where('id', '=', Auth::user()->id)->first();

        $IkuRealisasi = IkuRealisasi::select('id as iku_realisasi_id', 'iku_realisasi.*')
                        ->orderBy('created_at', 'ASC')
                        ->where('created_at', 'LIKE', date('Y').'%')
                        ->paginate(10);

        return view('admin.iku_realisasi.Components.iku_realisasi', compact('IkuRealisasi', 'user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        IkuRealisasi::create([
            'sasaran_strategis_id' => $request->sasaran_strategis_id,
            'indikator_kinerja_id' => $request->indikator_kinerja_id,
            'formula_id' => $request->formula_id,
            'target' => $request->target,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $IkuRealisasi = IkuRealisasi::findOrFail($id);
        $IkuRealisasi->update([
            'kode_iku' => $request->kode_iku,
            'sasaran_strategis_id' => $request->sasaran_strategis_id,
            'indikator_kinerja_id' => $request->indikator_kinerja_id,
            'formula_id' => $request->formula_id,
            'target' => $request->target,
            'target_tercapai' => $request->target_tercapai
        ]);

        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $IkuRealisasi = IkuRealisasi::findOrFail($id);
        $IkuRealisasi->delete();

        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

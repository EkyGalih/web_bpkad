<?php

namespace App\Http\Controllers\LKPD\Admin;

use App\Http\Controllers\Controller;
use App\Imports\KodeRekening as ImportsKodeRekening;
use App\Models\Lkpd\KodeRekening;
use App\Models\Lkpd\SubKodeRekening;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isNull;

class KodeRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $kodeRekening = KodeRekening::select('id as rekening_id', 'kode_rekening.*')->orderBy('kode_rekening', 'ASC')->paginate(10);
        $jenis_rekening = 'rekening';

        if ($id == null) {
            return view('lkpd.KodeRekening.KodeRekening', compact('kodeRekening', 'jenis_rekening'));
        } else {
            $rekeningDetail = KodeRekening::select('id as rekening_id', 'kode_rekening.*')->where('id', '=', $id)->first();
            return view('lkpd.KodeRekening.KodeRekening', compact('kodeRekening', 'rekeningDetail', 'jenis_rekening'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek_rekening = KodeRekening::where('kode_rekening', '=', $request->kode_rekening)->first();
        $cek_ref = KodeRekening::where('ref', '=', $request->ref)->first();
        if (isset($cek_rekening)) {
            return redirect()->back()->with(['warning' => 'kode rekeing ' . $request->kode_rekening . ' sudah ada!']);
        } elseif (isset($cek_ref)) {
            return redirect()->back()->with(['warning' => 'ref ' . $request->ref . ' sudah ada!']);
        } else {
            KodeRekening::create([
                'nama_rekening' => $request->nama_rekening,
                'kode_rekening' => $request->kode_rekening,
                'ref' => $request->ref
            ]);

            return redirect()->route('lkpk.kode-rekening')->with(['success' => 'Kode Rekening Ditambahkan!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KodeRekening  $kodeRekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kodeRekening = KodeRekening::findOrFail($id);
        $kodeRekening->update([
            'nama_rekening' => $request->nama_rekening,
            'kode_rekening' => $request->kode_rekening,
            'ref' => $request->ref
        ]);

        return redirect()->route('lkpk.kode-rekening')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * import data from excel
     *
     * @param \App\Models\KodeRekening $request
     */

    public function import(Request $request)
    {
        $file = $request->file('data-kode-rekening');
        $nama_file = rand() . '-' . $file->getCLientOriginalName();
        $file->move('import_data/', $nama_file);
        Excel::import(new ImportsKodeRekening, public_path('import_data/' . $nama_file));
        return redirect()->route('kode-rekening-admin')->with(['success' => 'Kode Rekening berhasil dibuat!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KodeRekening  $kodeRekening
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kode_rekening = KodeRekening::findOrFail($id);
        $kode_rekening->delete();

        return redirect()->route('lkpk.kode-rekening')->with(['success' => 'Data Kode Rekening Dihapus!']);
    }
}

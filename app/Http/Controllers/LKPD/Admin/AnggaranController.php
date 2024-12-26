<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UserAccess;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Imports\APBD as ImportsAPBD;
use App\Models\Apbd;
use App\Models\KodeRekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tahun = null)
    {
        $tahun = $tahun == null ? date('Y') : $tahun;

        $user = User::where('username', '=', Auth::user()->username)->select('id as user_id')->first();
        $kodeRekening = KodeRekening::select('id as kode_rek_id', 'kode_rekening.*')
                        ->orderBy('kode_rekening', 'ASC')
                        ->where('created_at', 'LIKE', $tahun.'%')
                        ->get();

        $CekApbd = Apbd::select('id as apbd_id', 'apbd.*')
                ->orderBy('kode_rekening', 'ASC')
                ->where('tahun_anggaran', '=', $tahun)
                ->get();

        if ($CekApbd->isEmpty()) {
            $Apbd = Apbd::select('id as apbd_id', 'apbd.*')
                ->orderBy('kode_rekening', 'ASC')
                ->where('tahun_anggaran', '=', $tahun-1)
                ->get();
        } else {
            $Apbd = Apbd::select('id as apbd_id', 'apbd.*')
                ->orderBy('kode_rekening', 'ASC')
                ->where('tahun_anggaran', '=', $tahun)
                ->get();
        }

        $data = [
            'nama_rekening' => array(),
            'data' => array(),
        ];

        $nama_rekening = [];
        foreach ($Apbd as $k => $val) {
            if (!isset($nama_rekening[$val->nama_rekening])) {
                $nama_rekening[$val->nama_rekening] = [];
            }
        }
        $kode_rekening = [];
        foreach ($Apbd as $k => $val) {
            if (!isset($kode_rekening[$val->kode_rekening])) {
                $kode_rekening[$val->kode_rekening] = [];
            }
        }

        $c_sort = count($nama_rekening);
        $i = 0;
        if (is_array($nama_rekening) && ($c_sort > 0)) {
            foreach ($nama_rekening as $k => $v) {
                array_push($data['nama_rekening'], $k);
                $kode = $Apbd->where('nama_rekening', '=', $k)->first();
                $data['data'][$k] = array(
                    'kode_rekening' => $kode->kode_rekening,
                    'nama_rekening' => $k,
                    'data' => array()
                );
            }
            foreach ($Apbd as $key => $val) {
                if (in_array($val->nama_rekening, $data['nama_rekening'])) {
                    if (!isset($data['data'][$val->nama_rekening]['data'])) {
                        $data['tahun_anggaran'] = $val->tahun_anggaran;
                        $data['data'][$val->nama_rekening]['data'] = [
                            'apbd_id'               => $val->apbd_id,
                            'kode_rekening'         => $val->kode_rekening,
                            'nama_rekening'         => $val->nama_rekening,
                            'uraian'                => $val->uraian,
                            'sub_uraian'            => $val->sub_uraian,
                            'jml_anggaran_sebelum'  => $val->jml_anggaran_sebelum,
                            'jml_anggaran_setelah'  => $val->jml_anggaran_setelah,
                            'selisih_anggaran'      => $val->selisih_anggaran,
                            'tahun_anggaran'        => $val->tahun_anggaran,
                            'persen'                => $val->persen
                        ];
                    } else {
                        $data['tahun_anggaran'] = $val->tahun_anggaran;
                        array_push($data['data'][$val->nama_rekening]['data'], [
                            'apbd_id'               => $val->apbd_id,
                            'kode_rekening'         => $val->kode_rekening,
                            'nama_rekening'         => $val->nama_rekening,
                            'uraian'                => $val->uraian,
                            'sub_uraian'            => $val->sub_uraian,
                            'jml_anggaran_sebelum'  => $val->jml_anggaran_sebelum,
                            'jml_anggaran_setelah'  => $val->jml_anggaran_setelah,
                            'selisih_anggaran'      => $val->selisih_anggaran,
                            'tahun_anggaran'        => $val->tahun_anggaran,
                            'persen'                => $val->persen
                        ]);
                    }
                }
            }
        }
        $Apbd = $data['data'];
        $cek_data = Apbd::select('tahun_anggaran')->groupBy('tahun_anggaran')->orderBy('tahun_anggaran', 'DESC')->limit(5)->get();
        $get_tahun = $cek_data == null ? [] : $cek_data;
        $tahun_anggaran = isset($data['tahun_anggaran']) ? $data['tahun_anggaran'] : date('Y');

        return view('admin.Apbd.apbd', compact('user', 'Apbd', 'kodeRekening', 'get_tahun', 'tahun_anggaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->uraian) && !isset($request->sub_uraian)) {

            $cekData = Apbd::where('kode_rekening', '=', $request->kode_rekening)->first();
            if (isset($cekData)) {
                return redirect()->back()->with(['warning' => 'Kode Rekening is already in use']);
            } else {
                Apbd::create([
                    'kode_rekening' => $request->kode_rekening,
                    'nama_rekening' => $request->nama_rekening,
                    'user_id'       => $request->user_id,
                    'tahun_anggaran' => date('Y')
                ]);
            }

        } elseif (!isset($request->sub_uraian)) {

            $cekData = Apbd::where('kode_rekening', '=', $request->kode_rekening2)->first();

            if (isset($cekData)) {
                return redirect()->back()->with(['warning' => 'Kode Rekening is already in use']);
            } else {
                Apbd::create([
                    'kode_rekening' => $request->kode_rekening2,
                    'nama_rekening' => $request->nama_rekening,
                    'uraian'        => $request->uraian,
                    'jml_anggaran_sebelum' => $request->jml_anggaran_sebelum,
                    'jml_anggaran_setelah' => $request->jml_anggaran_setelah,
                    'selisih_anggaran' => $request->selisih_anggaran,
                    'persen' => $request->persen,
                    'user_id'       => $request->user_id,
                    'tahun_anggaran' => date('Y')
                ]);
            }

        } elseif (isset($request->nama_rekening) && isset($request->uraian) && isset($request->sub_uraian)) {

            $cekData = Apbd::where('kode_rekening', '=', $request->kode_rekening3)->first();

            if (isset($cekData)) {
                return redirect()->back()->with(['warning' => 'Kode Rekening is already in use']);
            } else {
                $jml_anggaran_sebelum = Helpers::CurrencyConvertComa($request->jml_anggaran_sebelum);
                $jml_anggaran_setelah = Helpers::CurrencyConvertComa($request->jml_anggaran_setelah);
                $selisih_anggaran = Helpers::CurrencyConvertComa($request->selisih);
                $persen = Helpers::ConvertPersen($request->persen);

                Apbd::create([
                    'kode_rekening' => $request->kode_rekening3,
                    'nama_rekening' => $request->nama_rekening,
                    'uraian'        => $request->uraian,
                    'sub_uraian'    => $request->sub_uraian,
                    'jml_anggaran_sebelum' => $jml_anggaran_sebelum,
                    'jml_anggaran_setelah' => $jml_anggaran_setelah,
                    'selisih_anggaran' => $selisih_anggaran,
                    'persen' => $persen,
                    'user_id'       => $request->user_id,
                    'tahun_anggaran' => date('Y')
                ]);
            }

        }

        return redirect()->back()->with(['success' => 'Anggaran berhasil ditambah!']);
    }

    public function edit($id)
    {
        $apbd = Apbd::findOrFail($id);
        return view('admin.Apbd.Components.edit', compact('apbd'));
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
        $apbd = Apbd::findOrFail($id);
        $apbd->update([
            'jml_anggaran_setelah' => Helpers::CurrencyConvertComa($request->jml_anggaran_setelah),
            'selisih' => Helpers::CurrencyConvertComa($request->selisih),
            'persen' => Helpers::ConvertPersen($request->persen)
        ]);

        return redirect()->route('apbd')->with(['success' => 'Anggaran Berhasil Diubah!']);
    }

     /**
     * import data from excel
     *
     * @param \App\Models\Anggaran $request
     */

     public function import(Request $apbd)
     {
        $file = $apbd->file('data-apbd');
        $nama_file = rand() . '-' . $file->getCLientOriginalName();
        $file->move('import_data/', $nama_file);
        Excel::import(new ImportsAPBD, public_path('import_data/'.$nama_file));

        return redirect()->route('apbd')->with(['success' => 'APBD berhasil dibuat!']);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SubKegiatan = Apbd::findOrFail($id);
        $SubKegiatan->delete();

        return redirect()->route('apbd')->with(['success' => 'Sub Kegiatan Berhasil Dihapus!']);
    }
}

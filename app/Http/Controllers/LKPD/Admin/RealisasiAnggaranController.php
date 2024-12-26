<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UserAccess;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Apbd;
use App\Models\KodeRekening;
use App\Models\LaporanRealisasiAnggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealisasiAnggaranController extends Controller
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
            ->where('created_at', 'LIKE', $tahun . '%')
            ->get();

        if ($tahun == null) {
            $Apbd = Apbd::select('apbd.id as apbd_id', 'apbd.*', 'realisasi_anggaran.id as realisasi_anggaran_id', 'realisasi_anggaran.anggaran_terealisasi')
                ->join('realisasi_anggaran', 'apbd.kode_rekening', '=', 'realisasi_anggaran.kode_rekening')
                ->orderBy('apbd.kode_rekening', 'ASC')
                ->where('apbd.tahun_anggaran', '=',$tahun)
                ->where('realisasi_anggaran.tahun_anggaran', '=',$tahun)
                ->get();
        } elseif ($tahun != null) {
            $Apbd = Apbd::select('apbd.id as apbd_id', 'apbd.*', 'realisasi_anggaran.id as realisasi_anggaran_id', 'realisasi_anggaran.anggaran_terealisasi')
                ->join('realisasi_anggaran', 'apbd.kode_rekening', '=', 'realisasi_anggaran.kode_rekening')
                ->where('apbd.tahun_anggaran', '=', $tahun)
                ->where('realisasi_anggaran.tahun_anggaran', '=', $tahun)
                ->orderBy('apbd.kode_rekening', 'ASC')
                ->groupBy('kode_rekening')
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
                    'uraian' => $kode->uraian,
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
                            'persen'                => $val->persen,
                            'realisasi_anggaran_id' => $val->realisasi_anggaran_id,
                            'anggaran_terealisasi'  => $val->anggaran_terealisasi
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
                            'persen'                => $val->persen,
                            'realisasi_anggaran_id' => $val->realisasi_anggaran_id,
                            'anggaran_terealisasi'  => $val->anggaran_terealisasi
                        ]);
                    }
                }
            }
        }
        $Apbd = $data['data'];
        $get_tahun = Apbd::select('tahun_anggaran')->groupBy('tahun_anggaran')->orderBy('tahun_anggaran', 'DESC')->get();
        $tahun_anggaran = isset($data['tahun_anggaran']) ? $data['tahun_anggaran'] : date('Y');

        return view('admin.RealisasiAnggaran.realisasi-anggaran', compact('user', 'Apbd', 'kodeRekening', 'get_tahun', 'tahun_anggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Apbd = Apbd::where('kode_rekening', '=', $request->kode_rekening)->where('tahun_anggaran', '=', $request->tahun_anggaran)->select('jml_anggaran_setelah', 'tahun_anggaran')->first();
        $Anggaran = LaporanRealisasiAnggaran::where('kode_rekening', '=', $request->kode_rekening)->where('tahun_anggaran', '=', $request->tahun_anggaran)->first();
        $AnggaranBaru = Helpers::CurrencyConvertComa($request->anggaran_terealisasi);
        $SumAnggaran = $AnggaranBaru + $Anggaran->anggaran_terealisasi;

        if ($Apbd->jml_anggaran_setelah >= $SumAnggaran) {
            $Anggaran->update([
                'anggaran_terealisasi' => $SumAnggaran
            ]);

            return redirect()->route('realisasi-anggaran-admin')->with(['success' => 'Anggaran Berhasil Diupdate!']);
        } elseif ($Apbd->jml_anggaran_setelah < $SumAnggaran) {
            $Anggaran->update([
                'anggaran_terealisasi' => $SumAnggaran
            ]);
            return redirect()->route('realisasi-anggaran-admin')->with(['warning' => 'Anggaran Berhasil Diupdate, Tapi melebihi Pagu']);
        }
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

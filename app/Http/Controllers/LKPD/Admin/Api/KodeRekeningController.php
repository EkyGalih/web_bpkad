<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\KodeRekening;
use App\Models\SubKodeRekening;
use App\ResponseHandle;
use Illuminate\Http\Request;

class KodeRekeningController extends Controller
{

    private $kodeRekening;
    private $respHandler;

    public function __construct()
    {
        $this->kodeRekening = new KodeRekening();
        $this->respHandler = new ResponseHandle();
    }

    public function getOne()
    {
        $kodeRekening =  KodeRekening::select('id as rekening_id', 'kode_rekening.*')->get();
        return response()->json($kodeRekening);
    }

    public function getSpesifikRekening($jenis_rekening)
    {
        $kodeRekening = KodeRekening::select('id as rekening_id', 'kode_rekening.*')
            ->where('jenis_rekening', '=', $jenis_rekening)
            ->get();
        return response()->json($kodeRekening);
    }

    public function getRefRekening($id)
    {
        $kodeRekening = KodeRekening::select('id as rekening_id', 'nama_rekening','kode_rekening')
        ->where('id', '=', $id)
        ->first();
        return response()->json($kodeRekening);
    }

    public function getRefGroup($id)
    {
        $subKode = SubKodeRekening::select('id as rekening_id', 'nama_rekening', 'kode_rekening')
        ->where('kode_rekening_id', '=', $id)
        ->get();
        return response()->json($subKode);
    }

    public function getRefSub($id)
    {
        $subKode = SubKodeRekening::select('id as rekening_id', 'nama_rekening', 'kode_rekening')
        ->where('id', '=', $id)
        ->first();
        return response()->json($subKode);
    }

    public function getRekening($kode)
    {
        $KodeRekening = KodeRekening::select('id as kode_rekening_id', 'kode_rekening.kode_rekening', 'kode_rekening.nama_rekening')
        ->where('kode_rekening', 'LIKE', $kode.'%')
        ->orderBy('kode_rekening', 'ASC')
        ->get();

        return response()->json($KodeRekening);
    }

    public function getSubRekening($kode)
    {
        $kode = KodeRekening::where('kode_rekening', '=', $kode)->select('nama_rekening')->first();
        return response()->json($kode);
    }
}

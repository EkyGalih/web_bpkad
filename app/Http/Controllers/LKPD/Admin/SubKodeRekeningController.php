<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeRekening;
use App\Models\SubKodeRekening;
use Illuminate\Http\Request;

class SubKodeRekeningController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($id)
    {
        $sub_kode = SubKodeRekening::select('id as sub_kode_id', 'sub_kode_rekening.*')
        ->where('kode_rekening_id', '=', $id)
        ->orderBy('kode_rekening', 'ASC')
        ->get();

        if ($sub_kode->isEmpty())
        {
            $nama_rekening = '-';
        } else {
            $nama_rekening = $sub_kode[0]->nama_rekening;
        }

        return view('admin.KodeRekening.SubKode', compact('sub_kode', 'nama_rekening'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        SubKodeRekening::create([
            'nama_rekening' => $request->nama_rekening,
            'kode_rekening' => $request->kode_rekening,
            'kode_rekening_id' => $request->sub_kode_rekening
        ]);

        return redirect()->back()->with(['success' => 'Data Ditambahkan!']);
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
        $kodeRekening = KodeRekening::select('id as rekening_id', 'kode_rekening.*')->orderBy('kode_rekening', 'ASC')->get();

        $rekeningDetail = SubKodeRekening::select('id as rekening_id', 'sub_kode_rekening.*')
        ->where('id', '=', $id)
        ->first();
        $jenis_rekening = 'sub_rekening';

        return view('admin.KodeRekening.KodeRekening', compact('kodeRekening', 'rekeningDetail', 'jenis_rekening'));
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
        $sub_kode = SubKodeRekening::findOrFail($id);
        $sub_kode->delete();

        return redirect()->back()->with(['success' => 'Data Dihapus!']);
    }
}

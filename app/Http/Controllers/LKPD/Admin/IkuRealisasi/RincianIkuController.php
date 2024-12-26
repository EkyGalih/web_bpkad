<?php

namespace App\Http\Controllers\Admin\IkuRealisasi;

use App\Http\Controllers\Controller;
use App\Imports\RincianIkuImports;
use App\Models\FileIku;
use App\Models\KegiatanIku;
use App\Models\SubKegiatanIku;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RincianIkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KegiatanIku = KegiatanIku::where('tahun', '=', date('Y'))->groupby('divisi_id')->orderBy('divisi_id', 'DESC')->get();
        return view('admin.iku_realisasi.Components.rincian_iku', compact('KegiatanIku'));
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
        $SubKegiatan = SubKegiatanIku::findOrFail($id);

        return view('admin.iku_realisasi.Components.detail_rincian_iku', compact('SubKegiatan'));
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

    public function import(Request $request)
    {

        $file = $request->file('file-iku');
        $nama_file = rand() . '-' . $file->getClientOriginalName();
        $file->move('import_data/iku', $nama_file);
        Excel::import(new RincianIkuImports, public_path('import_data/iku/'.$nama_file));

        return redirect()->route('rincian-iku-admin')->with(['success' => 'Rincian Iku berhasil diupload!']);
    }

    public function upload(Request $request)
    {
        $sub_kegiatan = SubKegiatanIku::findOrFail($request->sub_kegiatan_id);

        $file = $request->file('file-bukti');
        $nama_file = $sub_kegiatan->kode_kegiatan_iku . '-' . $file->getClientOriginalName();

        $folder1 = 'import_data/iku/sub_kegiatan';
        $folder2 = $folder1.'/'.date('Y');
        $folder3 = $folder2.'/'.$sub_kegiatan->kode_kegiatan_iku;
        $folder4 = $folder3.'/'.$sub_kegiatan->indikator_kinerja;

        $explode = explode(" ",$sub_kegiatan->target_kinerja);
        $persen  = 100/$explode[0];
        $persentase = $sub_kegiatan->persentase + $persen;

        if (is_dir($folder1) == false) {
            mkdir($folder1);
        }
        if (is_dir($folder2) == false) {
            mkdir($folder2);
        }
        if (is_dir($folder3) == false) {
            mkdir($folder3);
        }
        if (is_dir($folder4) == false) {
            mkdir($folder4);
        }

        FileIku::create([
            'nama_file'             => $folder4.'/'.$nama_file,
            'sub_kegiatan_iku_id'   => $request->sub_kegiatan_id
        ]);

        $sub_kegiatan->update([
            'persentase'    => $persentase
        ]);

        $file->move($folder4, $nama_file);

        return redirect()->back()->with(['success' => 'Bukti Kegiatan Sudah Diupload!']);
    }
}

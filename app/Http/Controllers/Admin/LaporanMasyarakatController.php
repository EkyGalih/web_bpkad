<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan::orderBy('created_at', 'DESC')->get();

        return view('admin.faq.laporan.index', compact('laporan'));
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
    public function update(Request $request, Laporan $laporan)
    {
        $berkas     = $request->file('berkas_jawaban');

        if ($berkas != null) {
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG', 'pdf', 'xls', 'xlsx');
            $filename   = md5($berkas->getClientOriginalName()) . '.' . $berkas->getClientOriginalExtension();

            if (in_array($berkas->getClientOriginalExtension(), $ext)) {
                if ($berkas->getSize() <= 5000000) {
                    $path = $berkas->storeAs('uploads/laporan/jawaban', $filename, 's3');
                    if ($laporan->berkas_jawaban != null) {
                        // Hapus file lama dari S3 jika ada
                        Storage::disk('s3')->delete($laporan->berkas_jawaban);
                    }
                    $laporan->update([
                        'jawaban' => $request->jawaban,
                        'berkas_jawaban' => $path,
                        'jawaban_dari' => 'langsung'
                    ]);

                    return redirect()->back()->with(['success' => 'Jawaban sudah dikirim!']);
                } else {
                    return redirect()->back()->with(['warning_size' => 'Ukuran file melebihi 5MB']);
                }
            } else {
                return redirect()->back()->with(['warning_ext' => 'Ektensi File harus format JPG, JPEG, PNG, PDF, XLS, atau XLSX']);
            }
        } else {

            $laporan->update([
                'jawaban' => $request->jawaban,
                'berkas_jawaban' => $request->berkas_jawaban,
                'jawaban_dari' => 'langsung'
            ]);

            return redirect()->back()->with(['success' => 'Jawaban sudah dikirim!']);
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

<?php

namespace App\Http\Controllers\Operator\PPID;

use App\Http\Controllers\Controller;
use App\Models\KIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kip = KIP::orderBy('created_at', 'DESC')->get();

        return view('operator.ppid.kip.index', compact('kip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.ppid.kip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_informasi' => 'required',
            'jenis_informasi' => 'required',
            'jenis_file' => 'required',
            'upload_files' => 'required',
            'date' => 'required',
            'time' => 'required',
            'tahun' => 'required'
        ]);

        if ($request->jenis_file == 'link') {
            KIP::create([
                'nama_informasi' => $request->nama_informasi,
                'jenis_informasi' => $request->jenis_informasi,
                'jenis_file' => $request->jenis_file,
                'upload_by' => Auth::user()->id,
                'files' => $request->upload_files,
                'tahun' => $request->tahun,
                'created_at' => $request->date . ' ' . $request->time . ':' . date('s')
            ]);
        }

        return redirect()->route('ppid-op-kip')->with(['success' => 'Data informasi berhasil disimpan!']);
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
        $kip = KIP::findOrFail($id);

        return view('operator.ppid.kip.edit', compact('kip'));
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
        $kip = KIP::findOrFail($id);

        if ($kip->jenis_file == 'link') {
            $kip->update([
                'nama_informasi' => $request->nama_informasi,
                'jenis_informasi' => $request->jenis_informasi,
                'jenis_file' => $request->jenis_file,
                'files' => $request->upload_files,
                'tahun' => $request->tahun,
                'created_at' => $request->date . ' ' . $request->time
            ]);
        }

        return redirect()->route('ppid-op-kip.index')->with(['success' => 'Data informasi berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kip = KIP::findOrFail($id);

        if ($kip->jenis_file == 'link') {
            $kip->delete();
        }

        return redirect()->back()->with(['success' => 'Data berhasil dihapus!']);
    }
}

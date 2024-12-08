<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\KIP;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class KIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kip = KIP::orderBy('created_at', 'DESC')
            ->where('deleted_at', '=', NULL)
            ->get();
        $DeletedKIP = KIP::orderBy('created_at', 'DESC')
            ->where('deleted_at', '!=', NULL)
            ->get();

        return view('admin.ppid.kip.index', compact('kip', 'DeletedKIP'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ppid.kip.create');
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
            'date' => 'required',
            'time' => 'required',
            'tahun' => 'required'
        ]);

        if ($request->jenis_file === 'upload') {
            $request->validate([
                'upload_files' => 'required|file|mimes:pdf|max:5120',
            ]);

            // Upload file ke storage
            $filePath = $request->file('upload_files')->store('uploads/files', 'public');
        } else {
            // Jika jenis_file adalah "link", simpan link yang diinputkan
            $filePath = $request->upload_files;
        }

        $id = (string)Uuid::generate(4);

        KIP::create([
            'id' => $id,
            'nama_informasi' => $request->nama_informasi,
            'jenis_informasi' => $request->jenis_informasi,
            'jenis_file' => $request->jenis_file,
            'upload_by' => Auth::user()->id,
            'files' => $filePath,
            'tahun' => $request->tahun,
            'created_at' => $request->date . ' ' . $request->time . ':' . date('s')
        ]);

        Helpers::_recentAdd($id, 'mengupload file pada PPID informasi ' . $request->jenis_informasi, 'kip');

        return redirect()->route('ppid-kip.index')->with(['success' => 'Data informasi berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agenda()
    {
        return view('admin.ppid.agenda.index');
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

        return view('admin.ppid.kip.edit', compact('kip'));
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
        if ($request->jenis_file === 'upload') {
            $request->validate([
                'upload_files' => 'required|file|mimes:pdf|max:5120',
            ]);

            // Upload file ke storage
            $filePath = $request->file('upload_files')->store('uploads/files', 'public');
        } else {
            // Jika jenis_file adalah "link", simpan link yang diinputkan
            $filePath = $request->upload_files;
        }

        $kip = KIP::findOrFail($id);

        $kip->update([
            'nama_informasi' => $request->nama_informasi,
            'jenis_informasi' => $request->jenis_informasi,
            'jenis_file' => $request->jenis_file,
            'files' => $filePath,
            'tahun' => $request->tahun,
            'created_at' => $request->date . ' ' . $request->time
        ]);

        Helpers::_recentAdd($id, 'mengubah file pada PPID informasi ' . $request->jenis_informasi . ' menjadi', 'kip');

        return redirect()->route('ppid-kip.index')->with(['success' => 'Data informasi berhasil diubah!']);
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

        // $kip->delete();
        $kip->update([
            'deleted_at' => new DateTime()
        ]);

        Helpers::_recentAdd($id, 'menghapus file pada PPID informasi ' . $kip->jenis_informasi, 'kip');

        return redirect()->back()->with(['success' => 'Data berhasil dihapus!']);
    }
}

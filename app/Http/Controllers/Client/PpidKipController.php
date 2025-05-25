<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\KIP;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function App\Helpers\getKlasifikasiEnumFromInput;

class PpidKipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($klasifikasi, Request $request)
    {
        $query = $request->input('search', '');

        $data_kip = KIP::where('jenis_informasi', getKlasifikasiEnumFromInput($klasifikasi)->value)
            ->whereNull('deleted_at')
            ->where('nama_informasi', 'LIKE', '%' . $query . '%')
            ->orderByDesc('tahun')
            ->orderByDesc('updated_at')
            ->get()
            ->groupBy('tahun');

        $data = [];

        foreach ($data_kip as $tahun => $items) {
            $data[$tahun] = [
                'tahun' => $tahun,
                'kip' => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_informasi' => $item->nama_informasi,
                        'jenis_informasi' => $item->jenis_informasi,
                        'jenis_file' => $item->jenis_file,
                        'files' => $item->files,
                        'created_at' => $item->created_at,
                    ];
                })->toArray()
            ];
        }

        return view('client.PPID.kip.' . $klasifikasi, compact('data', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agenda($tahun = NULL)
    {
        $tahun = $tahun == NULL ? date('Y') : $tahun;
        $cek = Posts::where('agenda_kaban', '=', 'ya')
            ->orderBy('created_at', 'ASC')
            ->where('created_at', 'LIKE', $tahun . '%')
            ->paginate(10);
        switch ($cek) {
            case $cek->count() == 0:
                $tahun = $tahun == NULL ? date('Y') - 1 : $tahun;
                $agenda = Posts::where('agenda_kaban', '=', 'ya')
                    ->orderBy('created_at', 'ASC')
                    ->where('created_at', 'LIKE', $tahun . '%')
                    ->paginate(10);
                break;
            default:
                $agenda = Posts::where('agenda_kaban', '=', 'ya')
                    ->orderBy('created_at', 'ASC')
                    ->where('created_at', 'LIKE', $tahun . '%')
                    ->paginate(10);
                break;
        }
        
        return view('client.PPID.agenda.index', compact('agenda', 'tahun'));
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

    public function viewPDF($id)
    {
        $files = KIP::select('files')->findOrFail($id);
        if ($files->files && Str::contains($files->files, env('AWS_URL'))) {
            return redirect($files->files);
        } else {
            return response()->file(public_path('storage/' . $files->files));
        }
    }

    public function downloadPDF($id)
    {
        $files = KIP::select('files')->findOrFail($id);
        if ($files->files && Str::contains($files->files, env('AWS_URL'))) {
            // Mengunduh file dari URL eksternal
            return redirect($files->files);
        } else {
            // Mengunduh file dari penyimpanan lokal
            return response()->download(public_path('storage/' . $files->files));
        }
    }
}

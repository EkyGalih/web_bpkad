<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\KIP;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpidKipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kip_title = KIP::select('jenis_informasi')->groupBy('jenis_informasi')->get();
        $kip_content = KIP::get();
        $query = "";

        return view('client.PPID.kip.index', compact('kip_title', 'kip_content', 'query'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchBerkala(Request $request)
    {
        $query = $request->search;

        $kip_title = KIP::select('jenis_informasi')->groupBy('jenis_informasi')->get();
        $kip_content = KIP::get();

        return view('client.PPID.kip.index', compact('kip_title', 'kip_content', 'query'));
        // return response()->json($filterResult);
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
        return response()->file(public_path('storage/' . $files->files));
    }

    public function downloadPDF($id)
    {
        $files = KIP::select('files')->findOrFail($id);
        return response()->download(public_path('storage/' . $files->files));
    }
}

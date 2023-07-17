<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\KIP;
use App\Models\Posts;
use Illuminate\Http\Request;

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

        return view('client.PPID.kip.index', compact('kip_title', 'kip_content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agenda($tahun = NULL)
    {
        $tahun = $tahun == NULL ? date('Y')-1 : $tahun;
        $agenda = Posts::where('agenda_kaban', '=', 'ya')
                ->orderBy('created_at', 'ASC')
                ->where('created_at', 'LIKE', $tahun.'%')
                ->paginate(10);

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
    public function search(Request $request)
    {
        $query = $request->get('query');
        $filterResult = KIP::where('nama_informasi', 'LIKE', '%' . $query . '%')
            ->where('jenis_informasi', '=', 'berkala')
            ->pluck('nama_informasi');
        return response()->json($filterResult);
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
}

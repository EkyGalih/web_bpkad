<?php

namespace App\Http\Controllers\Simpeg\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Pegawai;
use App\ResponseHandle;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    private $bidang;
    private $respHandler;

    public function __construct()
    {
        $this->bidang = new Bidang();
        $this->respHandler = new ResponseHandle();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang = Bidang::orderBy('updated_at', 'desc')->latest()->get();

        $enc = Helpers::encrypt(json_encode($bidang));
        // cara decrypt
        $dec = json_decode(Helpers::decrypt($enc), true);

        return response()->json([
            'status' => 200,
            'data' => Helpers::encrypt(json_encode($bidang)),
            'data_dec' => $dec
        ]);
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
            'nama_bidang' => 'required'
        ]);
        config(['database.default' => 'simpeg']);
        Bidang::create([
            'nama_bidang' => $request->nama_bidang
        ]);

        return redirect()->route('bidang.index')->with(['success' => 'Data Bidang Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('pages.simpeg.admin.bidang.show', compact('bidang'));
    }

    public function getPegawai($id)
    {
        $pegawai = Pegawai::where('bidang_id', $id)->where('status_pegawai', 'aktif')->where('deleted_at', null)->paginate(6);
        $nama_bidang = Bidang::where('id', $id)->value('nama_bidang');

        return view('SimPeg.bidang.getPegawai', compact('pegawai', 'nama_bidang'));
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
        config(['database.default' => 'simpeg']);
        $bidang = Bidang::findOrFail($id);
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->save();

        return redirect()->route('bidang.index')->with(['success' => 'Data Bidang Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('simpeg.admin.bidang.index')->with(['success' => 'Data Bidang Berhasil Dihapus']);
    }
}


<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryVideo;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotos = Galery::where('galery_type_id', '=', '1')->get();
        $videos = Galery::where('galery_type_id', '=', '2')->get();

        return view('admin.galery.index', compact('fotos', 'videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = (string)Uuid::generate(4);
        if ($request->jenis_video == 'non-upload') {
            Galery::create([
                'id' => $id,
                'name' => $request->name,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'galery_type_id' => $request->galery_type_id
            ]);

            GaleryVideo::create([
                'id' => (string)Uuid::generate(4),
                'jenis_video' => $request->jenis_video,
                'path' => $request->path,
                'galery_id' => $id
            ]);

            Helpers::_recentAdd($id, 'membuat galery', 'galery');
            return redirect()->route('banner-video.index')->with(['success' => 'Galery berhasil ditambahkan!']);
        } elseif ($request->jenis_video == 'upload') {
            Galery::create([
                'id' => $id,
                'name' => $request->name,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'galery_type_id' => $request->galery_type_id
            ]);

            GaleryVideo::create([
                'id' => (string)Uuid::generate(4),
                'jenis_video' => $request->jenis_video,
                'path' => $request->path,
                'galery_id' => $id
            ]);

            Helpers::_recentAdd($id, 'membuat galery', 'galery');
            return redirect()->route('banner-video.index')->with(['success' => 'Galery berhasil ditambahkan!']);
        } else {
            Galery::create([
                'id' => $id,
                'name' => $request->name,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'galery_type_id' => $request->galery_type_id
            ]);

            Helpers::_recentAdd($id, 'membuat galery', 'galery');
            return redirect()->route('Gfoto-admin.create', $id)->with(['success' => 'Galery berhasil ditambahkan!']);
        }
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

<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryVideo;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class BannerVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = GaleryVideo::where('jenis_video', '=', 'non-upload')->groupBy('galery_id')->get();
        return view('admin.galery.video.banner.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galery.video.banner.add');
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
            'jenis_video' => 'required',
            'name' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'path' => 'required'
        ]);

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
        }

        return redirect()->route('banner-video.index')->with(['success' => 'Galery berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Galery::where('id', '=', $id)->first();
        $video  = GaleryVideo::where('galery_id', '=', $banner->id)->get();

        return view('admin.galery.video.banner.show', compact('banner', 'video'));
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

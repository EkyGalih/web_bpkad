<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryFoto;
use App\Models\GaleryVideo;

class GaleryController extends Controller
{
    public function foto()
    {
        $gallery = Galery::whereHas('galeryFoto')->get();

        return view('client.galery.foto.index', compact('gallery'));
    }

    public function video()
    {
        $gallery = Galery::whereHas('galeryVideo')->get();


        return view('client.galery.video.index', compact('gallery'));
    }

    public function show_foto(Galery $galery)
    {
        $fotos = GaleryFoto::where('galery_id', $galery->id)->paginate(8);

        return view('client.galery.foto.detail', compact('fotos', 'galery'));
    }

    public function show_video(Galery $galery)
    {
        $videos = GaleryVideo::where('galery_id', $galery->id)->paginate(8);
        
        return view('client.galery.video.detail', compact('videos', 'galery'));
    }
}

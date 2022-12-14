<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DaftarApp;
use App\Models\GaleryVideo;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function index()
    {
        $carousel = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->orderBy('posts.created_at', 'desc')
            ->first();
        $new_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->orderBy('posts.created_at', 'desc')
            ->limit(4)
            ->get();
        unset($new_posts[0]);
        $old_date   = date('m');
        $date       = $old_date-1;
        $new_date   = strlen($date) == 1 ? date('Y-0'.$date) : date('Y-'.$date);
        $old_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.created_at', 'LIKE', $new_date.'%')
            ->limit(4)
            ->get();
        $videos = GaleryVideo::join('galery', 'galery_video.galery_id', '=', 'galery.id')
            ->limit(1)
            ->get();
        $apps = DaftarApp::where('versi', '=', 'Web')
            ->get();
        $covid = Http::get('https://corona.ntbprov.go.id/api/data');
        $data_covid = $covid->json();
        return view('client.home.home', compact('new_posts', 'carousel', 'old_posts', 'videos','apps','data_covid'));
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
        $posts = Posts::where('id', '=', $id)->first();

        return view('client.home.detail_posts', compact('posts'));
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

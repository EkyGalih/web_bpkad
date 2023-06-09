<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DaftarApp;
use App\Models\GaleryVideo;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\Slideitem;
use App\Models\SubPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Jorenvh\Share\Share;
use Webpatser\Uuid\Uuid;

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
            ->limit(4)
            ->get();
        $new_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->orderBy('posts.created_at', 'desc')
            ->limit(8)
            ->get();
        unset($new_posts[0]);
        unset($new_posts[1]);
        unset($new_posts[2]);
        unset($new_posts[3]);
        $old_date   = date('m');
        $date       = $old_date - 1;
        $new_date   = strlen($date) == 1 ? date('Y-0' . $date) : date('Y-' . $date);
        $old_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.created_at', 'LIKE', $new_date . '%')
            ->limit(4)
            ->get();
        $videos = GaleryVideo::join('galery', 'galery_video.galery_id', '=', 'galery.id')
            ->limit(1)
            ->get();
        $banners = GaleryVideo::where('jenis_video', '=', 'non-upload')
            ->limit(9)
            ->get();
        $apps = DaftarApp::where('versi', '=', 'Web')
            ->get();

        // slider
        $slides = Slideitem::where('slide_id', '=', '2')->get();
        $slidesInformasi = Slideitem::where('slide_id', '=', '1')->where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->get();
        return view('client.home.home', compact('new_posts', 'carousel', 'old_posts', 'videos', 'apps', 'slides', 'slidesInformasi', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowPages($id)
    {
        $pages = Pages::findOrFail($id);

        return view('client.home.pages', compact('pages'));
    }

    public function ShowSubPages($id)
    {
        $subPages = SubPages::findOrFail($id);

        return view('client.home.sub_pages', compact('subPages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->paginate(16);

        return view('client.home.posts', compact('posts'));
    }

    public function PostCat($token1, $token2, $id)
    {
        $posts = Posts::where('posts_category_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('client.home.posts', compact('posts'));
    }

    public function PostTag($tags)
    {
        $posts = Posts::where('tags', 'LIKE', '%'.$tags.'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(12);

        return view('client.home.posts_by_tags', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token1, $id, $token2)
    {
        $posts = Posts::where('id', '=', $id)->first();
        $share = \Share::page(
            url()->full(),
            $posts->title,
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view('client.home.detail_posts', compact('posts', 'share'));
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

    public function _NotFound()
    {
        return view('client.not_found');
    }
}

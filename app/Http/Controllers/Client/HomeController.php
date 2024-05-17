<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DaftarApp;
use App\Models\GaleryVideo;
use App\Models\KIP;
use App\Models\Olympic;
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
            ->where('posts.deleted_at', '=', NULL)
            ->where('posts.posts_category_id', '=', '1')
            ->limit(4)
            ->get();
        $new_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->where('posts_category_id', '=', '1')
            ->orderBy('posts.created_at', 'desc')
            ->limit(8)
            ->get();
        $artikels = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->where('posts_category_id', '=', '2')
            ->orderBy('posts.created_at', 'desc')
            ->limit(6)
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
        $slides = Slideitem::where('slide_id', '=', '2')->where('deleted_at', '=', NULL)->get();
        $slidesInformasi = Slideitem::where('slide_id', '=', '1')->where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->get();

        $agenda = Posts::where('agenda_kaban', '=', 'ya')
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        $informasi = KIP::where('jenis_informasi', '=', 'berkala')
            ->where('tahun', '=', date('Y'))
            ->limit(13)
            ->orWhere('tahun', '=', date('Y') - 1)
            ->orderBy('tahun', 'DESC')
            ->limit(13)
            ->get();

        // berita luar
        // politik
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://berita-indo-api-next.vercel.app/api/antara-news/politik');
        $response = json_decode($res->getBody()->getContents());
        $data = $response->data;
        // $politiks = $data['posts'];

        return view('client.home.home', compact('new_posts', 'artikels', 'carousel', 'old_posts', 'videos', 'apps', 'slides', 'slidesInformasi', 'banners', 'agenda', 'informasi', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowPages($id)
    {
        $pages = Pages::findOrFail($id);

        return view('client.pages.pages', compact('pages'));
    }

    public function ShowSubPages($id)
    {
        $subPages = SubPages::findOrFail($id);

        return view('client.pages.sub_pages', compact('subPages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        $posts = Posts::where('posts_category_id', '=', '1')
            ->where('deleted_at', '=', NULL)
            ->orderBy('created_at', 'DESC')
            ->paginate(16);
        $cari = "Seluruh Berita";

        return view('client.posts.posts', compact('posts', 'cari'));
    }

    public function PostTag($tags)
    {
        $posts = Posts::where('tags', 'LIKE', '%' . $tags . '%')
            ->orderBy('created_at', 'DESC')
            ->where('deleted_at', '=', NULL)
            ->paginate(12);

        return view('client.posts.posts_by_tags', compact('posts'));
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

        return view('client.posts.detail_posts', compact('posts', 'share'));
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


    public function olympic()
    {
        $olympics = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.uuid')
            ->orderBy('emas', 'DESC')
            ->orderBy('perak', 'DESC')
            ->orderBy('perunggu', 'DESC')
            ->orderBy('total', 'DESC')
            ->select(
                'bidang.nama_bidang',
                'olympic.*'
            )
            ->get();
        $champions = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.uuid')
            ->orderBy('emas', 'DESC')
            ->orderBy('perak', 'DESC')
            ->orderBy('perunggu', 'DESC')
            ->orderBy('total', 'DESC')
            ->select(
                'bidang.nama_bidang',
                'olympic.*'
            )
            ->first();
        $rank = Olympic::join('bidang', 'olympic.bidang_id', '=', 'bidang.uuid')
            ->orderBy('emas', 'DESC')
            ->orderBy('perak', 'DESC')
            ->orderBy('perunggu', 'DESC')
            ->orderBy('total', 'DESC')
            ->select(
                'olympic.emas',
                'olympic.perak',
                'olympic.perunggu',
                'olympic.total',
            )
            ->get()->toArray();

        $ranks = [];

        foreach ($rank as $item) {
            array_push($ranks, $item);
        }

        $emas1 = $ranks[0]['emas'];
        $emas2 = $ranks[1]['emas'];
        $emas3 = $ranks[2]['emas'];

        $perak1 = $ranks[0]['perak'];
        $perak2 = $ranks[1]['perak'];
        $perak3 = $ranks[2]['perak'];

        $perunggu1 = $ranks[0]['perunggu'];
        $perunggu2 = $ranks[1]['perunggu'];
        $perunggu3 = $ranks[2]['perunggu'];

        $max1 = $ranks[0]['total'];
        $max2 = $ranks[1]['total'];
        $max3 = $ranks[2]['total'];

        return view('client.olympic.olympic', compact('olympics', 'champions', 'max1', 'max2', 'max3', 'emas1', 'emas2', 'emas3', 'perak1', 'perak2', 'perak3', 'perunggu1', 'perunggu2', 'perunggu3'));
    }
}

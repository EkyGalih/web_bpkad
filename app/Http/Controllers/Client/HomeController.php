<?php

namespace App\Http\Controllers\Client;

use App\Enum\CategoryEnum;
use App\Http\Controllers\Controller;
use App\Models\Olympic;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\Slideitem;
use App\Models\SubPages;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $new_posts = Posts::join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.id as type_id',
            )
            ->where('posts_category_id', '=', '1')
            ->orderBy('posts.created_at', 'desc')
            ->limit(3)
            ->get();

        $agendas = Posts::where('agenda_kaban', '=', 'ya')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();

        $information = Slideitem::where('slide_id', '2')->where('is_active', '1')->get();

        // berita ntb
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://ntbprov.go.id/api/news');
        $response = json_decode($res->getBody()->getContents());
        $data = $response->data;

        return view('client.home.home', compact('new_posts', 'agendas', 'data', 'information'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pages($slug)
    {
        $pages = Pages::where('slug', $slug)->first();

        return view('client.pages.pages', compact('pages'));
    }

    public function sub_pages($slug)
    {
        $subPages = SubPages::where('slug', $slug)->first();

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

        return view('client.posts.posts_by_tags', compact('posts', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug = null)
    {
        switch ($category) {
            case CategoryEnum::BERITA->value:
                if ($slug != null) {
                    $posts = Posts::query()
                        ->where('posts_category_id', 1)
                        ->where('slug', $slug)
                        ->first();
                } else {
                    $posts = Posts::query()
                        ->where('posts_category_id', 1)
                        ->first();
                }

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
                break;
            case CategoryEnum::ARTIKEL->value:
                if ($slug != null) {
                    $artikel = Posts::query()
                        ->where('posts_category_id', 2)
                        ->where('slug', $slug)
                        ->first();
                } else {
                    $artikel = Posts::query()
                        ->where('posts_category_id', 2)
                        ->first();
                }

                $share = \Share::page(
                    url()->full(),
                    $artikel->title,
                )
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->telegram()
                    ->whatsapp()
                    ->reddit();
                return view('client.artikel.detail_artikel', compact('artikel', 'share'));
                break;
            case CategoryEnum::AGENDAPIMPINAN->value:
                if ($slug != null) {
                    $posts = Posts::query()
                        ->where('posts_category_id', 3)
                        ->where('slug', $slug)
                        ->first();
                } else {
                    $posts = Posts::query()
                        ->where('posts_category_id', 3)
                        ->first();
                }

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
                break;
        }
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

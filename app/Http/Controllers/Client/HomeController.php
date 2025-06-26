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
use Illuminate\Support\Facades\DB;

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
        $dbSimpeg = DB::connection('simpeg')->getDatabaseName();
        // Ambil semua data olympic + nama bidang dengan urutan emas, perak, perunggu, total
        $olympics = Olympic::join("$dbSimpeg.bidang", 'olympic.bidang_id', '=', "$dbSimpeg.bidang.id")
            ->orderByDesc('emas')
            ->orderByDesc('perak')
            ->orderByDesc('perunggu')
            ->orderByDesc('total')
            ->select("$dbSimpeg.bidang.nama_bidang", 'olympic.*')
            ->get();

        // Juara 1
        $champions = $olympics->first();

        // Ambil 3 besar untuk ranking
        $topThree = $olympics->take(3);

        // Gunakan null coalescing untuk mencegah error jika datanya kurang dari 3
        $emas1 = $topThree[0]->emas ?? 0;
        $emas2 = $topThree[1]->emas ?? 0;
        $emas3 = $topThree[2]->emas ?? 0;

        $perak1 = $topThree[0]->perak ?? 0;
        $perak2 = $topThree[1]->perak ?? 0;
        $perak3 = $topThree[2]->perak ?? 0;

        $perunggu1 = $topThree[0]->perunggu ?? 0;
        $perunggu2 = $topThree[1]->perunggu ?? 0;
        $perunggu3 = $topThree[2]->perunggu ?? 0;

        $max1 = $topThree[0]->total ?? 0;
        $max2 = $topThree[1]->total ?? 0;
        $max3 = $topThree[2]->total ?? 0;

        return view('client.olympic.olympic', compact(
            'olympics',
            'champions',
            'max1',
            'max2',
            'max3',
            'emas1',
            'emas2',
            'emas3',
            'perak1',
            'perak2',
            'perak3',
            'perunggu1',
            'perunggu2',
            'perunggu3'
        ));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function index()
    {
        $menu = DB::table('menu')->get();
        $posts = DB::table('posts')
            ->join('content_type', 'posts.content_type_id', '=', 'content_type.id')
            ->select(
                'posts.*',
                'posts.id as posts_id',
                'content_type.*',
                'content_type.id as type_id',
            )
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.posts.posts', compact('menu', 'posts'));
    }

    public function comment(Request $request, $id)
    {
        $post = Posts::findOrFail($id);

        PostComment::create([
            'post_id' => $post->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'komentar' => $request->komentar,
            'ip_addr' => $request->ip_addr
        ]);

        return redirect()->back();
    }

    public function like($id)
    {
        $post = Posts::findOrFail($id);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

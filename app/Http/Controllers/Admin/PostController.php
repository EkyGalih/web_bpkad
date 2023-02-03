<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\PostsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->get();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PostCategory = PostsCategory::orderBy('category', 'ASC')->get();

        return view('admin.post.add', compact('PostCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $foto       = $request->file('foto_berita');
        $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
        $filename   = 'eky-' . md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();

        if (in_array($foto->getClientOriginalExtension(), $ext)) {
            if ($foto->getSize() <= 5000000) {
                $foto->move('uploads/berita/', $filename);
                $request->foto_berita = 'uploads/berita/' . $filename;
            }
        }
        Posts::create([
            'title' => $request->title,
            'content' => $request->content,
            'content_type_id' => '1',
            'foto_berita' => $request->foto_berita,
            'users_id' => Auth::user()->id,
            'posts_category_id' => $request->posts_category_id
        ]);

        return redirect()->route('post-admin.index')->with(['success' => 'Posting berhasil diupload!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::findOrFail($id);
        $PostCategory = PostsCategory::orderBy('category', 'ASC')->get();

        return view('admin.post.edit', compact('posts', 'PostCategory'));
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
        $posts      = Posts::findOrFail($id);
        $foto       = $request->file('foto_berita');

        if ($foto != null) {
            // dd($foto->getSize());
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $filename   = 'eky-' . md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();

            if (in_array($foto->getClientOriginalExtension(), $ext)) {
                if ($foto->getSize() <= 5000000) {
                    unlink($posts->foto_berita);
                    $foto->move('uploads/berita/', $filename);
                    $request->foto_berita = 'uploads/berita/' . $filename;
                }
            }
           $posts->update([
                'title' => $request->title,
                'content' => $request->content,
                'content_type_id' => '1',
                'foto_berita' => $request->foto_berita,
                'users_id' => Auth::user()->id,
                'posts_category_id' => $request->posts_category_id
            ]);
        } elseif ($foto == null) {
            // dd('null');
            $posts->update([
                'title' => $request->title,
                'content' => $request->content,
                'content_type_id' => '1',
                'foto_berita' => $posts->foto_berita,
                'users_id' => Auth::user()->id,
                'posts_category_id' => $request->posts_category_id
            ]);
        }

        return redirect()->route('post-admin.index')->with(['success' => 'Posting berhasil diupload!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        unlink($post->foto_berita);
        $post->delete();

        return redirect()->route('post-admin.index')->with(['success' => 'Postingan dihapus!']);
    }
}

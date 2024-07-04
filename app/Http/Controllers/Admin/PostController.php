<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\PostsCategory;
use App\Models\Recent;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::where('deleted_at', '=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach ($posts as $value) {
            $post = Posts::findOrFail($value->id);
            $post->update(['slug' => Str::slug($value->title)]);
        }

        $DeletedPosts = Posts::where('deleted_at', '!=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.post.index', compact('posts', 'DeletedPosts'));
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
        $foto       = $request->file('foto_berita');
        $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
        $filename   = 'berita-' . md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();
        $id         = (string)Uuid::generate(4);

        if (in_array($foto->getClientOriginalExtension(), $ext)) {
            if ($foto->getSize() <= 5000000) {
                if ($request->posts_category_id == '1') {
                    $foto->move('uploads/berita/', $filename);
                    $request->foto_berita = 'uploads/berita/' . $filename;
                } elseif ($request->posts_category_id == '2') {
                    $foto->move('uploads/artikel/', $filename);
                    $request->foto_berita = 'uploads/artikel/' . $filename;
                }
            }
        }

        Posts::create([
            'id' => $id,
            'title' => $request->title,
            'slug'  => $request->slug,
            'content' => $request->content,
            'content_type_id' => '1',
            'foto_berita' => $request->foto_berita,
            'users_id' => Auth::user()->id,
            'caption' => $request->caption,
            'posts_category_id' => $request->posts_category_id || 1,
            'tags' => $request->tags,
            'agenda_kaban' => $request->agenda_kaban,
            'created_at' => $request->date . ' ' . $request->time . ':' . date('s')
        ]);

        Helpers::_recentAdd($id, 'membuat Berita/Artikel', 'post');

        return redirect()->route('post-admin.index')->with(['success' => 'Berita/Artikel berhasil diupload!']);
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
                    if ($request->posts_category_id == '1') {
                        $foto->move('uploads/berita/', $filename);
                        $request->foto_berita = 'uploads/berita/' . $filename;
                    } elseif ($request->posts_category_id == '2') {
                        $foto->move('uploads/artikel/', $filename);
                        $request->foto_berita = 'uploads/artikel/' . $filename;
                    }
                }
            }
            $posts->update([
                'title' => $request->title,
                'slug'  => $request->slug,
                'content' => $request->content,
                'content_type_id' => '1',
                'foto_berita' => $request->foto_berita,
                'users_id' => Auth::user()->id,
                'posts_category_id' => $request->posts_category_id,
                'tags' => $request->tags,
                'caption' => $request->caption,
                'agenda_kaban' => $request->agenda_kaban,
                'created_at' => $request->date . ' ' . $request->time
            ]);
            Helpers::_recentAdd($id, 'mengubah posting', 'post');
        } elseif ($foto == null) {
            $posts->update([
                'title' => $request->title,
                'content' => $request->content,
                'content_type_id' => '1',
                'foto_berita' => $posts->foto_berita,
                'users_id' => Auth::user()->id,
                'posts_category_id' => $request->posts_category_id,
                'tags' => $request->tags,
                'caption' => $request->caption,
                'agenda_kaban' => $request->agenda_kaban,
                'created_at' => $request->date . ' ' . $request->time
            ]);
            Helpers::_recentAdd($id, 'mengubah Berita/Artikel', 'post');
        }

        return redirect()->route('post-admin.index')->with(['success' => 'Berita/Artikel berhasil diupload!']);
    }

    public function restore($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'deleted_at' => NULL
        ]);

        Helpers::_recentAdd($id, 'memulihkan berita/artikel yang dihapus', 'post');

        return redirect()->route('post-admin.index')->with(['success' => 'Berita/Artikel berhasil dipulihkan!']);
    }

    public function agenda($id)
    {
        $agenda = Posts::findOrFail($id);
        if ($agenda->agenda_kaban == 'ya') {
            $agenda->update([
                'agenda_kaban'    => 'tidak'
            ]);
            return redirect()->route('post-admin.index')->with(['success' => 'Agenda kaban berhasil ditambahkan!']);
        } else {
            $agenda->update([
                'agenda_kaban'    => 'ya'
            ]);
            return redirect()->route('post-admin.index')->with(['success' => 'Agenda kaban berhasil dihapus!']);
        }
    }

    /**
     * Remove the specified resource from storage temporary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'deleted_at' => new DateTime()
        ]);

        return redirect()->route('post-admin.index')->with(['success' => 'Berita/Artikel dipindahkan ke tong sampah!']);
    }

    /**
     * Remove the specified resource from storage permanent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = Posts::findOrFail($id);
        $recent = Recent::where('uuid_activity', '=', $id)->get();
        foreach ($recent as $item) {
            $item->delete();
        }
        if (file_exists($post->foto_berita)) {
            unlink($post->foto_berita);
        }
        $post->delete();

        return redirect()->route('post-admin.index')->with(['success' => 'Berita/Artikel dihapus permanen!']);
    }

    /**
     * clear all data from reycicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clear()
    {
        $posts = Posts::where('deleted_at', '!=', NULL)->get();
        foreach ($posts as $post) {
            $recent = Recent::where('uuid_activity', '=', $post->id)->first();
            if ($recent != NULL) {
                $recent->delete();
            }
            if ($post->foto_berita != NULL) {
                unlink($post->foto_berita);
            }
            $post->delete();
        }

        return redirect()->route('post-admin.index')->with(['success' => 'File Sampah berhasil dibersihkan!']);
    }
}

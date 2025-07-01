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
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;
use ReCaptcha\RequestMethod\Post;

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
        $tags = get_tags();

        return view('admin.post.add', compact('PostCategory', 'tags'));
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
            'foto_berita' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $file = $request->file('foto_berita');
        $path = $file->store('uploads/berita', 's3');
        $url = config('filesystems.disks.s3.url') . '/' . $path;
        // dd($request->posts_category_id);
        $post = new Posts();
        $post->id = (string)Uuid::generate(4);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->content_type_id = '1';
        $post->foto_berita = $url;
        $post->users_id = Auth::id();
        $post->caption = $request->caption;
        $post->posts_category_id = $request->posts_category_id ?? 1;
        $post->tags = json_encode(collect(json_decode($request->tags))->pluck('value'));
        $post->agenda_kaban = $request->agenda_kaban;
        $post->save();

        // hanya untuk menyimpan ke history
        $category = PostsCategory::where('id', $request->posts_category_id)->value('category');

        _recentAdd($post->id, 'membuat ' . $category, 'post');
        return redirect()->route('post-admin.index')
            ->with('success', $category . ' berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        $PostCategory = PostsCategory::orderBy('category', 'ASC')->get();
        $tags = get_tags();

        return view('admin.post.edit', compact('post', 'PostCategory', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        $request->validate([
            'foto_berita' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        ]);

        $url = $post->foto_berita; // Gunakan foto lama jika tidak ada yang diunggah

        if ($request->hasFile('foto_berita')) {
            // Hapus file lama dari S3 jika ada
            if ($post->foto_berita && Str::contains($post->foto_berita, env('AWS_URL'))) {
                $oldPath = str_replace(env('AWS_URL') . '/', '', $post->foto_berita);
                Storage::disk('s3')->delete($oldPath);
            }

            // Upload file baru ke S3
            $file = $request->file('foto_berita');
            $path = $file->store('uploads/berita', 's3');
            $url = config('filesystems.disks.s3.url') . '/' . $path;
        }

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->content_type_id = '1';
        $post->foto_berita = $url;
        $post->users_id = Auth::id();
        $post->posts_category_id = $request->posts_category_id ?? 1; // Default kategori jika kosong
        $post->tags = json_encode(collect(json_decode($request->tags))->pluck('value'));
        $post->caption = $request->caption;
        $post->agenda_kaban = $request->agenda_kaban;
        $post->save();

        // hanya untuk menyimpan ke history
        $category = PostsCategory::where('id', $post->posts_category_id)->value('category');

        _recentAdd($post->id, 'mengubah '.$category, 'post');
        return redirect()->route('post-admin.index')->with('success', $category.' berhasil diperbarui!');
    }

    public function restore(Posts $post)
    {
        $post->update([
            'deleted_at' => NULL
        ]);

        _recentAdd($post->id, 'memulihkan berita/artikel yang dihapus', 'post');

        return redirect()->route('post-admin.index')->with('success', 'Berita/Artikel berhasil dipulihkan!');
    }

    public function agenda(Posts $post)
    {
        $agenda = Posts::findOrFail($post->id);
        if ($agenda->agenda_kaban == 'ya') {
            $agenda->update([
                'agenda_kaban' => 'tidak'
            ]);
            _recentAdd($post->id, 'menghapus agenda pimpinan', 'post');
            return redirect()->route('post-admin.index')->with('success', 'Agenda kaban berhasil ditambahkan!');
        } else {
            $agenda->update([
                'agenda_kaban' => 'ya'
            ]);
            _recentAdd($post->id, 'mengubah Berita/Artikel menjadi agenda pimpinan', 'post');
            return redirect()->route('post-admin.index')->with('success', 'Agenda kaban berhasil dihapus!');
        }
    }

    /**
     * Remove the specified resource from storage temporary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        $post->update([
            'deleted_at' => new DateTime()
        ]);

        _recentAdd($post->id, 'memindahkan ke tong sampah Berita/Artikel', 'post');
        return redirect()->route('post-admin.index')->with('success','Berita/Artikel dipindahkan ke tong sampah!');
    }

    /**
     * Remove the specified resource from storage permanent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Posts $post)
    {

        // Hapus data Recent terkait
        Recent::where('uuid_activity', $post->id)->delete();

        // Hapus foto dari S3 jika ada
        if ($post->foto_berita && Str::contains($post->foto_berita, env('AWS_URL'))) {
            $oldPath = str_replace(env('AWS_URL') . '/', '', $post->foto_berita);
            Storage::disk('s3')->delete($oldPath);
        }

        // Hapus postingan dari database
        $post->delete();
        _recentAdd($post->id, 'menghapus Berita/Artikel', 'post');
        return redirect()->route('post-admin.index')->with('success', 'Berita/Artikel dihapus permanen!');
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
            if ($post->foto_berita && Str::contains($post->foto_berita, env('AWS_URL'))) {
                $oldPath = str_replace(env('AWS_URL') . '/', '', $post->foto_berita);
                Storage::disk('s3')->delete($oldPath);
            }
            $post->delete();
        }

        _recentAdd($post->id, 'm,embersihkan tong sampah Berita/Artikel', 'post');
        return redirect()->route('post-admin.index')->with(['success' => 'File Sampah berhasil dibersihkan!']);
    }
}

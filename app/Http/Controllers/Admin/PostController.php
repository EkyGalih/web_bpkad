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
        $request->validate([
            'foto_berita' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $file = $request->file('foto_berita');
        $path = $file->store('uploads/berita', 's3');
        $url = config('filesystems.disks.s3.url') . '/' . $path;

        $id         = (string)Uuid::generate(4);

        Posts::create([
            'id' => $id,
            'title' => $request->title,
            'slug'  => $request->slug,
            'content' => $request->content,
            'content_type_id' => '1',
            'foto_berita' => $url,
            'users_id' => Auth::user()->id,
            'caption' => $request->caption,
            'posts_category_id' => $request->posts_category_id || 1,
            'tags' => $request->tags,
            'agenda_kaban' => $request->agenda_kaban,
            'created_at' => $request->date . ' ' . $request->time . ':' . now()->format('s')
        ]);

        Helpers::_recentAdd($id, 'membuat Berita/Artikel', 'post');
        session()->flash('success', 'Berita/Artikel berhasil ditambahkan!');
        return redirect()->route('post-admin.index');
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
        $request->validate([
            'foto_berita' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        ]);

        $posts = Posts::findOrFail($id);
        $url = $posts->foto_berita; // Gunakan foto lama jika tidak ada yang diunggah

        if ($request->hasFile('foto_berita')) {
            // Hapus file lama dari S3 jika ada
            if ($posts->foto_berita && Str::contains($posts->foto_berita, env('AWS_URL'))) {
                $oldPath = str_replace(env('AWS_URL') . '/', '', $posts->foto_berita);
                Storage::disk('s3')->delete($oldPath);
            }

            // Upload file baru ke S3
            $file = $request->file('foto_berita');
            $path = $file->store('uploads/berita', 's3');
            $url = config('filesystems.disks.s3.url') . '/' . $path;
        }

        $posts->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'content_type_id' => '1',
            'foto_berita' => $url,
            'users_id' => Auth::id(),
            'posts_category_id' => $request->posts_category_id ?? 1, // Default kategori jika kosong
            'tags' => $request->tags,
            'caption' => $request->caption,
            'agenda_kaban' => $request->agenda_kaban,
            'created_at' => ($request->date && $request->time)
                ? $request->date . ' ' . $request->time . ':' . now()->format('s')
                : now(),
        ]);

        Helpers::_recentAdd($id, 'mengubah posting', 'post');
        session()->flash('success', 'Berita/Artikel berhasil diubah!');
        return redirect()->route('post-admin.index');
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

        // Hapus data Recent terkait
        Recent::where('uuid_activity', $id)->delete();

        // Hapus foto dari S3 jika ada
        if ($post->foto_berita && Str::contains($post->foto_berita, env('AWS_URL'))) {
            $oldPath = str_replace(env('AWS_URL') . '/', '', $post->foto_berita);
            Storage::disk('s3')->delete($oldPath);
        }

        // Hapus postingan dari database
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
            if ($post->foto_berita && Str::contains($post->foto_berita, env('AWS_URL'))) {
                $oldPath = str_replace(env('AWS_URL') . '/', '', $post->foto_berita);
                Storage::disk('s3')->delete($oldPath);
            }
            $post->delete();
        }

        return redirect()->route('post-admin.index')->with(['success' => 'File Sampah berhasil dibersihkan!']);
    }
}

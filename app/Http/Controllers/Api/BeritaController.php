<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Posts::join('users', 'posts.users_id', '=', 'users.id')
                ->orderBy('created_at', 'DESC')
                ->select(
                    'users.nama as author',
                    'posts.id',
                    'posts.title',
                    'posts.content',
                    'posts.foto_berita',
                    'posts.tags',
                    'posts.created_at',
                    'users.avatar'
                    )
                ->get();

        return new BeritaResource(true, 'Data Berita !', $berita);
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title'             => 'required',
    //         'content'           => 'required',
    //         'foto_berita'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'content_type_id'   => 'required',
    //         'users_id'          => 'required',
    //         'posts_category_id'  => 'required',
    //         'agenda_kaban'      => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     // upload image
    //     $image = $request->file('foto_berita');
    //     $image->storeAs('uploads/berita', $image->hashName());

    //     $post = Posts::create([
    //         'id'                => (string)Uuid::generate(4),
    //         'title'             => $request->title,
    //         'content'           => $request->content,
    //         'foto_berita'       => 'uploads/berita/' . $image->hashName(),
    //         'content_type_id'   => $request->content_type_id,
    //         'users_id'          => $request->users_id,
    //         'tags'              => $request->tags,
    //         'caption'           => $request->caption,
    //         'posts_category_id'  => $request->post_category_id,
    //         'agenda_kaban'      => $request->agenda_kaban
    //     ]);

    //     return new BeritaResource(true, 'Data Berita berhasil ditambahkan!', $post);
    // }

    public function show($id)
    {
        $berita = Posts::findOrFail($id);

        if ($berita) {
            return new BeritaResource(true, 'Data Berita !', $berita);
        } else {
            return response()->json([
                'message'   => 'Data not found!'
            ], 422);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $post = Posts::findOrFail($id);
    //     // return $request;
    //     $validator = Validator::make($request->all(), [
    //         'title'             => 'required',
    //         'content'           => 'required',
    //         'foto_berita'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
    //         'content_type_id'   => 'required',
    //         'users_id'          => 'required',
    //         'posts_category_id'  => 'required',
    //         'agenda_kaban'      => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     if ($request->file('foto_berita')) {
    //         // upload image
    //         $image = $request->file('foto_berita');
    //         $image->storeAs('uploads/berita', $image->hashName());

    //         $post->update([
    //             'title'             => $request->title,
    //             'content'           => $request->content,
    //             'foto_berita'       => 'uploads/berita/' . $image->hashName(),
    //             'content_type_id'   => $request->content_type_id,
    //             'users_id'          => $request->users_id,
    //             'tags'              => $request->tags,
    //             'caption'           => $request->caption,
    //             'posts_category_id' => $request->posts_category_id,
    //             'agenda_kaban'      => $request->agenda_kaban
    //         ]);
    //     } else {
    //         $post->update([
    //             'title'             => $request->title,
    //             'content'           => $request->content,
    //             'content_type_id'   => $request->content_type_id,
    //             'users_id'          => $request->users_id,
    //             'tags'              => $request->tags,
    //             'caption'           => $request->caption,
    //             'posts_category_id'  => $request->posts_category_id,
    //             'agenda_kaban'      => $request->agenda_kaban
    //         ]);
    //     }

    //     return new BeritaResource(true, 'Data post berhasil diubah!', $post);
    // }

    // public function destroy($id)
    // {
    //     $post = Posts::findOrFail($id);

    //     Storage::delete($post->foto_berita);
    //     $post->delete();

    //     return new BeritaResource(true, 'Data post berhasil dihapus!', NULL);
    // }
}

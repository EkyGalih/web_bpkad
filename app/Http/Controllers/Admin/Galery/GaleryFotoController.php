<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GaleryFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Galery::where('galery_type_id', '1')->orderByDesc('created_at')->get();

        return view('admin.galery.foto.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Galery $galery)
    {
        return view('admin.galery.foto.partials.add', compact('galery'));
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
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'galery_id' => 'required|exists:galery,id'
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format file tidak didukung. Hanya JPG, JPEG, PNG yang diperbolehkan.',
            'file.max' => 'Ukuran file terlalu besar. Maksimal 2MB.',
            'galery_id.required' => 'ID galeri diperlukan.',
            'galery_id.exists' => 'Galeri tidak ditemukan.'
        ]);

        if ($request->hasFile('file')) {
            $galery = Galery::findOrFail($request->galery_id);
            $galery_name = $galery->name;
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            Storage::disk('s3')->put("uploads/galery/foto/$galery_name/{$filename}", file_get_contents($file), 'public');

            $url = Storage::disk('s3')->url("uploads/galery/foto/$galery_name/{$filename}");

            GaleryFoto::create([
                'galery_id' => $galery->id,
                'path' => $url
            ]);

            return response()->json(['success' => true, 'url' => $url]);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Galery $foto)
    {
        $fotos = GaleryFoto::where('galery_id', $foto->id)->orderByDesc('created_at')->paginate(9);

        return view('admin.galery.foto.detail', compact('fotos', 'foto'));
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
    public function destroy(GaleryFoto $foto)
    {
        try {
            // Pastikan ada path
            if ($foto->path) {
                // Ambil path relatif dari URL
                $relativePath = Str::after($foto->path, Storage::disk('s3')->url(''));

                // Hapus dari S3 jika file ada
                if (Storage::disk('s3')->exists($relativePath)) {
                    Storage::disk('s3')->delete($relativePath);
                }
            }

            // Hapus dari database
            $foto->delete();

            _recentAdd($foto->galery_id, ' menghapus foto di galery '. $foto->galery->name, 'galery foto');
            return redirect()->back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }
}

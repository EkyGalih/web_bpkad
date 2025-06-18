<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleryVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Galery::where('galery_type_id', '2')->orderByDesc('created_at')->get();

        return view('admin.galery.video.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Galery $galery)
    {
        return view('admin.galery.video.partials.add', compact('galery'));
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
            'file' => 'required|mimetypes:video/mp4|max:10240',
            'galery_id' => 'required|exists:galery,id'
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimetypes' => 'Format file tidak didukung. Hanya MP4 yang diperbolehkan.',
            'file.max' => 'Ukuran file terlalu besar. Maksimal 10MB.',
            'galery_id.required' => 'ID galeri diperlukan.',
            'galery_id.exists' => 'Galeri tidak ditemukan.'
        ]);

        if ($request->hasFile('file')) {
            $galery = Galery::findOrFail($request->galery_id);
            $galery_name = $galery->name;
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            Storage::disk('s3')->put("uploads/galery/video/$galery_name/{$filename}", file_get_contents($file), 'public');

            $url = Storage::disk('s3')->url("uploads/galery/video/$galery_name/{$filename}");

            GaleryVideo::create([
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
    public function show(Galery $video)
    {
        $videos = GaleryVideo::where('galery_id', $video->id)->orderByDesc('created_at')->paginate(9);

        return view('admin.galery.video.detail', compact('videos', 'video'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaleryVideo $video)
    {
        try {
            // Pastikan ada path
            if ($video->path) {
                // Ambil path relatif dari URL
                $relativePath = Str::after($video->path, Storage::disk('s3')->url(''));

                // Hapus dari S3 jika file ada
                if (Storage::disk('s3')->exists($relativePath)) {
                    Storage::disk('s3')->delete($relativePath);
                }
            }

            // Hapus dari database
            $video->delete();

            _recentAdd($video->galery_id, ' menghapus video di galery ' . $video->galery->name, 'galery video');
            return redirect()->back()->with('success', 'Video berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryFoto;
use Illuminate\Support\Str;
use App\Models\GaleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotos = Galery::where('galery_type_id', '=', '1')->get();
        $videos = Galery::where('galery_type_id', '=', '2')->get();

        return view('admin.galery.index', compact('fotos', 'videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $galery = new Galery();
        if ($request->galery_type_id == 1) {
            $galery->id = (string) Uuid::generate(4);
            $galery->name = $request->nama;
            $galery->keterangan = $request->keterangan;
            $galery->galery_type_id = $request->galery_type_id;
            $galery->tanggal =  now()->toDateString();
            $galery->save();

            _recentAdd($galery->id, ' menambah galery foto baru', 'galery foto');

            return redirect()->route('galery-foto.create', $galery->id)->with('success', 'Galery ' . $galery->name . ' berhasil dibuat');
        } elseif ($request->galery_type_id == 2) {
            $galery->id = (string) Uuid::generate(4);
            $galery->name = $request->nama;
            $galery->keterangan = $request->keterangan;
            $galery->galery_type_id = $request->galery_type_id;
            $galery->tanggal =  now()->toDateString();
            $galery->save();

            _recentAdd($galery->id, ' menambah galery vide baru', 'galery video');

            return redirect()->route('galery-video.create', $galery->id)->with('success', 'Galery ' . $galery->name . ' berhasil dibuat');
        } else {
            return redirect()->back()->withErrors(['fail' => 'Tipe galeri tidak valid.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, Galery $galery)
    {
        $oldName = $galery->name;
        $newName = $request->nama;

        // Update galery data
        $galery->update([
            'name' => $newName,
            'keterangan' => $request->keterangan
        ]);

        // Rename folder in S3 if galery name changed
        if ($oldName !== $newName) {
            $fotos = GaleryFoto::where('galery_id', $galery->id)->get();

            foreach ($fotos as $foto) {
                $oldUrl = $foto->path;

                // Dapatkan path relatif dari URL S3
                $relativePath = Str::after($oldUrl, Storage::disk('s3')->url('/'));

                // Hitung path baru
                $newRelativePath = str_replace("uploads/galery/foto/{$oldName}", "uploads/galery/foto/{$newName}", $relativePath);

                // Pindahkan file di S3
                if (Storage::disk('s3')->exists($relativePath)) {
                    Storage::disk('s3')->move($relativePath, $newRelativePath);

                    // Simpan URL baru ke DB
                    $foto->path = Storage::disk('s3')->url($newRelativePath);
                    $foto->save();
                }
            }
        }

        _recentAdd($galery->id, 'Mengubah galery foto', 'galery foto');

        return redirect()->back()->with('success', 'Galery foto berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery)
    {
        $fotos = GaleryFoto::where('galery_id', $galery->id)->get();

        foreach ($fotos as $f) {
            if ($f->path) {
                // Ambil path relatif dari URL
                $relativePath = Str::after($f->path, Storage::disk('s3')->url('/'));

                // Hapus file dari S3
                Storage::disk('s3')->delete($relativePath);
            }

            // Hapus record dari DB
            $f->delete();
        }

        $galery->delete();

        _recentAdd($galery->id, 'Menghapus galery foto', 'galery foto');

        return redirect()->back()->with('success', 'Galery foto berhasil dihapus!');
    }
}

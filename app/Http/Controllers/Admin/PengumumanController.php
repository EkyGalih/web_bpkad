<?php

namespace App\Http\Controllers\Admin;

use App\Enum\SlideEnum;
use App\Http\Controllers\Controller;
use App\Models\Slideitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Slideitem::where('slide_id', '2')->where('deleted_at', '=', NULL)->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengumuman.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255',
                'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $imageUrl = null;

            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('uploads/pengumuman/slider', 's3');
                Storage::disk('s3')->setVisibility($path, 'public');
                $imageUrl = Storage::disk('s3')->url($path);
            }

            Slideitem::create([
                'title' => $request->title,
                'keterangan' => $request->keterangan,
                'slide_id' => 2,
                'foto' => $imageUrl,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil disimpan.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slideitem $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
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
}

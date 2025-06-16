<?php

namespace App\Http\Controllers\Admin\Galery;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\GaleryFoto;
use Illuminate\Http\Request;

class GaleryFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Galery::where('galery_type_id', '1')->get();

        return view('admin.galery.foto.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.galery.foto.uploadFoto', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = md5($image).'.'.$image->extension();
        $image->move('uploads/galery/foto/', $imageName);
        return response()->json(['success' => $imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Galery $foto)
    {
        $fotos = GaleryFoto::where('galery_id', $foto->id)->paginate(9);

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
    public function destroy($id)
    {
        //
    }
}

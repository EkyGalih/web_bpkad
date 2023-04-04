<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Slideitem;
use DateTime;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider     = Slideitem::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->get();
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slide = Slide::get();
        return view('admin.slider.create', compact('slide'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = (string)Uuid::generate(4);

        Slideitem::create([
            'id' => $id,
            'title' => $request->title,
            'keterangan' => $request->keterangan,
            'slide_id' => $request->slide_id,
            'foto' => '',
            'url' => ''
        ]);

        Helpers::_recentAdd($id, 'menambahkan slide', 'slider');

        return redirect()->route('slider.index')->with(['success' => 'Slide berhasil ditambahkan!']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slide::get();
        $slider = Slideitem::findOrFail($id);

        return view('admin.slider.edit', compact('slider', 'slide'));
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
        $slider = Slideitem::findOrFail($id);

        $slider->update([
            'title' => $request->title,
            'keterangan' => $request->keterangan,
            'slide_id' => $request->slide_id,
        ]);
        Helpers::_recentAdd($id, 'mengubah slide', 'slider');

        return redirect()->route('slider.index')->with(['success' => 'Slide berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slideitem::findOrFail($id);
        $slider->update([
            'deleted_at' => new DateTime()
        ]);
        Helpers::_recentAdd($id, 'menghapus slide', 'slider');

        return redirect()->route('slider.index')->with(['success' => 'Slide berhasil dihapus!']);
    }
}

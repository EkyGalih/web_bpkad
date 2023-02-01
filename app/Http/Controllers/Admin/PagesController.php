<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\PagesType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::orderBy('created_at', 'DESC')->get();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('name', 'ASC')->get();

        return view('admin.pages.add', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pages::create([
            'title' => $request->title,
            'content' => $request->content,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'menu_id' => $request->menu_id
        ]);

        return redirect()->route('pages-admin.index')->with(['success' => 'Pages berhasil ditambahkan!']);
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
        $menus = Menu::orderBy('name', 'ASC')->get();
        $pages = Pages::findOrFail($id);

        return view('admin.pages.edit', compact('pages', 'menus'));
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
        $pages = Pages::findOrFail($id);

        $pages->update([
            'title' => $request->title,
            'content' => $request->content,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'menu_id' => $request->menu_id
        ]);

        return redirect()->route('pages-admin.index')->with(['success' => 'Pages berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pages = Pages::findOrFail($id);
        $pages->delete();

        return redirect()->route('pages-admin.index')->with(['success' => 'Pages berhasil dihapus!']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')->get();
        $pages = Pages::orderBy('title', 'ASC')->get();

        return view('admin.menu.index', compact('menus','pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Menu::create([
            'name' => $request->name,
            'order_pos' => $request->order_pos,
            'url' => $request->url,
            'create_by_id' => Auth::user()->id
        ]);

        return redirect()->route('menu-admin.index')->with(['success' => 'Menu berhasil ditambahkan!']);
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
        $menu = Menu::findOrFail($id);

        $menu->update([
            'name' => $request->name,
            'order_pos' => $request->order_pos ?? '0',
            'url' => $request->url,
            'create_by_id' => Auth::user()->id
        ]);

        return redirect()->route('menu-admin.index')->with(['success' => 'Menu berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu-admin.index')->with(['success' => 'Menu berhasil dihapus!']);

    }
}

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
        $menus = Menu::orderBy('order_pos', 'asc')->get();
        $pages = Pages::orderBy('title', 'ASC')->get();

        return view('admin.menu.index', compact('menus', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastMenu = Menu::orderBy('order_pos', 'desc')->first();
        $newOrderPos = $lastMenu ? $lastMenu->order_pos + 1 : 1;

        $menu = new Menu();
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->order_pos = $newOrderPos;
        $menu->create_by_id = Auth::user()->id;
        $menu->save();

        _recentAdd($menu->id, 'Menambahkan '.$menu->name.' sebagai menu baru', 'Menu');

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
            'url' => $request->url,
            'create_by_id' => Auth::user()->id
        ]);

        _recentAdd($menu->id, 'Mengubah nama '.$menu->name, 'Menu');

        return response()->json(['success' => true, 'message' => 'Menu berhasil diubah!']);
    }

    // use Illuminate\Http\Request;
    public function sort(Request $request)
    {
        foreach ($request->order as $item) {
            Menu::where('id', $item['id'])->update([
                'order_pos' => $item['position']
            ]);
        }
        return response()->json(['success' => true]);
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

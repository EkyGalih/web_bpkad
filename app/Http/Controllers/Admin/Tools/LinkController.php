<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Li;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Links::orderByDesc('created_at')->get();

        return view('admin.Tools.Links.index', compact('links'));
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
            'name' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        $link = new Links();
        $link->name = $request->name;
        $link->link = $request->link;
        $link->save();

        _recentAdd($link->id, ' menambahkan link', 'Link');

        return redirect()->back()->with('success', 'Link berhasil disimpan!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Links $link)
    {
        $link->update([
            'name' => $request->name,
            'link' => $request->link
        ]);

        _recentAdd($link->id, ' mengupdate link', 'Link');

        return redirect()->back()->with('success', 'Link berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Links $link)
    {
        $link->delete();

        return redirect()->back()->with('success', 'Link berhasil dihapus!');
    }
}

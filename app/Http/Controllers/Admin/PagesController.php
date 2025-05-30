<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\Recent;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::where('deleted_at', '=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

        $DeletedPages = Pages::where('deleted_at', '!=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.pages.page.index', compact('pages', 'DeletedPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('name', 'ASC')->get();

        return view('admin.pages.page.add', compact('menus'));
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
        // dd($request->all());
        if ($request->jenis_link == 'non-link') {
            Pages::create([
                'id' => $id,
                'jenis_link' => $request->jenis_link,
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'pages_type_id' => '1',
                'create_by_id' => Auth::user()->id,
                'menu_id' => $request->menu_id
            ]);
        } elseif ($request->jenis_link == 'link') {
            Pages::create([
                'id' => $id,
                'jenis_link' => $request->jenis_link,
                'link' => $request->link,
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'pages_type_id' => '1',
                'create_by_id' => Auth::user()->id,
                'menu_id' => $request->menu_id
            ]);
        }
        _recentAdd($id, 'membuat halaman', 'pages');

        return redirect()->route('pages-admin.index')->with('success', 'Pages berhasil ditambahkan!');
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
    public function edit(Pages $page)
    {
        $menus = Menu::orderBy('name', 'ASC')->get();

        return view('admin.pages.page.edit', compact('page', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $page)
    {

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'menu_id' => $request->menu_id
        ]);

        _recentAdd($page->id, 'memperbaharui halaman', 'pages');

        return redirect()->route('pages-admin.index')->with('success', 'Pages berhasil diubah!');
    }

    /**
     * Restore  the files in the reycicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function restore(Pages $page)
    {
        $page->update([
            'deleted_at' => NULL
        ]);

        _recentAdd($page->id, 'mengembalikan halaman yang dihapus', 'pages');

        return redirect()->route('pages-admin.index')->with('success', 'Halaman berhasil dipulihkan1!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $page)
    {
        $page->update([
            'deleted_at' => new DateTime()
        ]);

        _recentAdd($page->id, 'menghapus halaman', 'pages');

        return redirect()->route('pages-admin.index')->with('success', 'Halaman ditaruh ke tong sampah!');
    }

    /**
     * Remove the specified resource from storage permanent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Pages $page)
    {
        $recent = Recent::where('uuid_activity', '=', $page->id)->get();
        foreach ($recent as $item) {
            $item->delete();
        }
        $page->delete();

        return redirect()->route('pages-admin.index')->with('success', 'Halaman dihapus permanen!');
    }

    /**
     * clear all data from reycicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clear()
    {
        $pages = Pages::where('deleted_at', '!=', NULL)->get();
        foreach ($pages as $page) {
            $recent = Recent::where('uuid_activity', '=', $page->id)->first();
            if ($recent != NULL) {
                $recent->delete();
            }
            $page->delete();
        }

        return redirect()->route('pages-admin.index')->with(['success' => 'Tong Sampah dibersihkan!']);
    }
}

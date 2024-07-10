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

            foreach ($pages as $page) {
                $hal = Pages::findOrFail($page->id);
                $hal->update([
                    'slug' => Str::slug($page->title),
                ]);
            }

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
        Helpers::_recentAdd($id, 'membuat halaman', 'pages');

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

        return view('admin.pages.page.edit', compact('pages', 'menus'));
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
            'slug' => $request->slug,
            'content' => $request->content,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'menu_id' => $request->menu_id
        ]);

        Helpers::_recentAdd($id, 'memperbaharui halaman', 'pages');

        return redirect()->route('pages-admin.index')->with(['success' => 'Pages berhasil diubah!']);
    }

    /**
     * Restore  the files in the reycicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function restore($id)
    {
        $page = Pages::findOrFail($id);
        $page->update([
            'deleted_at' => NULL
        ]);

        Helpers::_recentAdd($id, 'mengembalikan halaman yang dihapus', 'pages');

        return redirect()->route('pages-admin.index')->with(['success' => 'Halaman berhasil dipulihkan1!']);
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
        $pages->update([
            'deleted_at' => new DateTime()
        ]);

        Helpers::_recentAdd($id, 'menghapus halaman', 'pages');

        return redirect()->route('pages-admin.index')->with(['success' => 'Halaman ditaruh ke tong sampah!']);
    }

    /**
     * Remove the specified resource from storage permanent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $pages = Pages::findOrFail($id);
        $recent = Recent::where('uuid_activity', '=', $id)->get();
        foreach ($recent as $item) {
            $item->delete();
        }
        $pages->delete();

        return redirect()->route('pages-admin.index')->with(['success' => 'Halaman dihapus permanen!']);
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

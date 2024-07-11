<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\Recent;
use App\Models\SubPages;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;

class SubPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subpages = SubPages::where('deleted_at', '=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

            foreach ($subpages as $page) {
                $hal = SubPages::findOrFail($page->id);
                $hal->update([
                    'slug' => Str::slug($page->title),
                ]);
            }

        $DeletedSubPages = SubPages::where('deleted_at', '!=', NULL)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.pages.subpage.index', compact('subpages', 'DeletedSubPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Pages::orderBy('title', 'ASC')->get();

        return view('admin.pages.subpage.add', compact('pages'));
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
            $ext = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $pdf = $request->file('pdf_file');

            if ($pdf != null) {
                $filename = md5($pdf->getClientOriginalName()) . '.' . $pdf->getClientOriginalExtension();

                if (in_array($pdf->getClientOriginalExtension(), $ext)) {
                    if ($pdf->getSize() <= 5000000) {
                        $pdf->move('uploads/pages/subpage/', $filename);
                        $request->pdf_file = 'uploads/pages/subpage/' . $filename;
                    } else {
                        return redirect()->back()->with(['warning_size' => 'Ukuran file melebihi 5MB!']);
                    }
                } else {
                    return redirect()->back()->with(['warning_ext' => 'Ektensi File harus format PNG, JPG atau JPEG!']);
                }

                SubPages::create([
                    'id' => $id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'pages_type_id' => '1',
                    'pdf_file' => $request->pdf_file,
                    'create_by_id' => Auth::user()->id,
                    'sub_pages_id' => $request->sub_pages_id
                ]);
            } else {
                SubPages::create([
                    'id' => $id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'pages_type_id' => '1',
                    'create_by_id' => Auth::user()->id,
                    'sub_pages_id' => $request->sub_pages_id
                ]);
            }
            Helpers::_recentAdd($id, 'menambahkan sub halaman', 'sub_pages');
            return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil ditambahkan!']);
        } elseif ($request->jenis_link == 'link') {
            SubPages::create([
                'id' => $id,
                'jenis_link' => $request->jenis_link,
                'link' => $request->link,
                'title' => $request->title,
                'slug' => $request->slug,
                'pages_type_id' => '1',
                'create_by_id' => Auth::user()->id,
                'sub_pages_id' => $request->sub_pages_id
            ]);
            Helpers::_recentAdd($id, 'menambahkan sub halaman', 'sub_pages');
            return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil ditambahkan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Pages::orderBy('title', 'ASC')->get();
        $subpages = SubPages::findOrFail($id);

        return view('admin.pages.subpage.edit', compact('pages', 'subpages'));
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
        $subpages = SubPages::findOrFail($id);

        $subpages->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'link' => $request->link,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'sub_pages_id' => $request->sub_pages_id
        ]);
        Helpers::_recentAdd($id, 'mengubah halaman', 'sub_pages');

        return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil diubah!']);
    }

    public function restore($id)
    {
        $subpage = SubPages::findOrFail($id);
        $subpage->update([
            'deleted_at' => NULL
        ]);

        Helpers::_recentAdd($id, 'mengembalikan sub halaman yang dihapus', 'sub_pages');

        return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Halaman berhasil dipulihkan1!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subpages = SubPages::findOrFail($id);
        $subpages->update([
            'deleted_at' => new DateTime()
        ]);
        // if ($subpages->pdf_file != null) {
        //     unlink($subpages->pdf_file);
        // }
        // $subpages->delete();
        Helpers::_recentAdd($id, 'menghapus halaman', 'sub_pages');

        return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil dihapus!']);
    }

    /**
     * Remove the specified resource from storage permanent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $subpages = SubPages::findOrFail($id);
        $recent = Recent::where('uuid_activity', '=', $id)->get();
        foreach ($recent as $item) {
            $item->delete();
        }
        $subpages->delete();

        return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Halaman dihapus permanen!']);
    }

    /**
     * clear all data from reycicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clear()
    {
        $subpages = SubPages::where('deleted_at', '!=', NULL)->get();
        foreach ($subpages as $spage) {
            $recent = Recent::where('uuid_activity', '=', $spage->id)->first();
            if ($recent != NULL) {
                $recent->delete();
            }
            $spage->delete();
        }

        return redirect()->route('subpages-admin.index')->with(['success' => 'Tong Sampah dibersihkan!']);
    }
}

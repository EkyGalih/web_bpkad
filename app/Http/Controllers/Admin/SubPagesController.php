<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\SubPages;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class SubPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subpages = SubPages::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')->get();

        return view('admin.pages.subpage.index', compact('subpages'));
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
                    'content' => $request->content,
                    'pages_type_id' => '1',
                    'create_by_id' => Auth::user()->id,
                    'sub_pages_id' => $request->sub_pages_id
                ]);
            }
            return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil ditambahkan!']);
        } elseif ($request->jenis_link == 'link') {
            SubPages::create([
                'id' => $id,
                'jenis_link' => $request->jenis_link,
                'link' => $request->link,
                'title' => $request->title,
                'pages_type_id' => '1',
                'create_by_id' => Auth::user()->id,
                'sub_pages_id' => $request->sub_pages_id
            ]);
            return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil ditambahkan!']);
        }

        Helpers::_recentAdd($id, 'menambahkan sub halaman', 'sub_pages');
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
            'content' => $request->content,
            'link' => $request->link,
            'pages_type_id' => '1',
            'create_by_id' => Auth::user()->id,
            'sub_pages_id' => $request->sub_pages_id
        ]);
        Helpers::_recentAdd($id, 'mengubah halaman', 'sub_pages');

        return redirect()->route('subpages-admin.index')->with(['success' => 'Sub Pages berhasil diubah!']);
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
}

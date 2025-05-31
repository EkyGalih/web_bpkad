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
use Illuminate\Support\Facades\Storage;
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
            $ext = array('pdf');
            $pdf = $request->file('pdf_file');

            if ($pdf != null) {
                if (in_array($pdf->getClientOriginalExtension(), $ext)) {
                    if ($pdf->getSize() <= 5000000) {
                        $filename = md5($pdf->getClientOriginalName()) . '.' . $pdf->getClientOriginalExtension();
                        try {
                            $path = Storage::disk('s3')->putFileAs('uploads/pages/subpages', $pdf, $filename);
                            if (!$path) {
                                return back()->withInput()->with('error', 'Gagal mengupload file ke S3.');
                            }
                            $url = Storage::disk('s3')->url($path); // Cara resmi untuk dapatkan URL publik
                        } catch (\Exception $e) {
                            return back()->withInput()->with('error', 'Gagal upload: ' . $e->getMessage());
                        }
                    } else {
                        return back()->withInput()->with('error', 'Ukuran file melebihi 5MB!');
                    }
                } else {
                    return back()->withInput()->with('error', 'Ektensi File harus format PDF!');
                }

                SubPages::create([
                    'id' => $id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'pages_type_id' => '1',
                    'pdf_file' => $url,
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
            _recentAdd($id, 'menambahkan sub halaman', 'sub_pages');
            return redirect()->route('subpages-admin.index')->with('success', 'Sub Pages berhasil ditambahkan!');
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
            _recentAdd($id, 'menambahkan sub halaman', 'sub_pages');
            return redirect()->route('subpages-admin.index')->with('success', 'Sub Pages berhasil ditambahkan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubPages $subpage)
    {
        $pages = Pages::orderBy('title', 'ASC')->get();

        return view('admin.pages.subpage.edit', compact('pages', 'subpage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubPages $subpage)
    {
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $allowedExt = ['pdf'];
        // dd($request->all());
        try {

            if ($request->jenis_link === 'non-link') {
                $pdf = $request->file('pdf_file');
                $url = $subpage->pdf_file; // default, biar tetap pakai file lama kalau tidak diupload ulang

                if ($pdf) {
                    $ext = $pdf->getClientOriginalExtension();

                    if (!in_array($ext, $allowedExt)) {
                        return back()->withInput()->with('error', 'Ekstensi file harus PDF!');
                    }

                    if ($pdf->getSize() > $maxFileSize) {
                        return back()->withInput()->with('error', 'Ukuran file melebihi 5MB!');
                    }

                    $filename = md5($pdf->getClientOriginalName() . time()) . '.' . $ext;
                    $path = Storage::disk('s3')->putFileAs('uploads/pages/subpages', $pdf, $filename);

                    if (!$path) {
                        return back()->withInput()->with('error', 'Gagal mengupload file ke S3.');
                    }

                    $url = Storage::disk('s3')->url($path);
                }

                $subpage->update([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'pages_type_id' => 1,
                    'pdf_file' => $url,
                    'jenis_link' => 'non-link',
                    'link' => null,
                    'sub_pages_id' => $request->sub_pages_id,
                    'update_by_id' => Auth::id()
                ]);
            } elseif ($request->jenis_link === 'link') {
                $subpage->update([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'pages_type_id' => 1,
                    'jenis_link' => 'link',
                    'link' => $request->link,
                    'pdf_file' => null,
                    'content' => null,
                    'sub_pages_id' => $request->sub_pages_id,
                    'update_by_id' => Auth::id()
                ]);
            } else {
                return back()->withInput()->with('error', 'Jenis link tidak valid.');
            }

            _recentAdd($subpage->id, 'mengubah sub halaman', 'sub_pages');
            return redirect()->route('subpages-admin.index')->with('success', 'Sub Pages berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        $subpage = SubPages::findOrFail($id);
        $subpage->update([
            'deleted_at' => NULL
        ]);

        _recentAdd($id, 'mengembalikan sub halaman yang dihapus', 'sub_pages');

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
        _recentAdd($id, 'menghapus halaman', 'sub_pages');

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

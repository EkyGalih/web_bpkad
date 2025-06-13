<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Models\Apps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apps = Apps::orderBy('created_at', 'DESC')->get();

        return view('admin.Tools.apps.index', compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Tools.apps.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $icon       = $request->file('icon');
        $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
        $filename   = md5($icon->getClientOriginalName()) . '.' . $icon->getClientOriginalExtension();

        if (in_array($icon->getClientOriginalExtension(), $ext)) {
            if ($icon->getSize() <= 5000000) {
                $path = $icon->storeAs('uploads/profile/logo_apps', $filename, 's3');
                $request->icon = $path;
            }
        }

        $apps = new Apps();
        $apps->name = $request->name;
        $apps->versi = $request->versi;
        $apps->deskripsi = $request->deskripsi;
        $apps->icon = $request->icon;
        $apps->create_by_id = Auth::user()->id;
        $apps->url = $request->url;
        $apps->save();

        _recentAdd($apps->id, ' menambahkan aplikasi', 'apps');

        return redirect()->route('apps.index')->with('success', 'Apps berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apps $apps)
    {

        return view('admin.tools.apps.edit', compact('apps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apps $apps)
    {
        $icon   = $request->file('icon');

        if ($icon != null) {
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $filename   = md5($icon->getClientOriginalName()) . '.' . $icon->getClientOriginalExtension();

            if (in_array($icon->getClientOriginalExtension(), $ext)) {
                if ($icon->getSize() <= 5000000) {
                    // Hapus file lama dari S3 jika ada
                    if ($apps->icon && Storage::disk('s3')->exists($apps->icon)) {
                        Storage::disk('s3')->delete($apps->icon);
                    }
                    // Upload file baru ke S3
                    $path = $icon->storeAs('uploads/profile/logo_apps', $filename, 's3');
                    $request->icon = $path;
                }
            }

            $apps->name = $request->name;
            $apps->icon = $request->icon;
            $apps->versi = $request->versi;
            $apps->deskripsi = $request->deskripsi;
            $apps->create_by_id = Auth::user()->id;
            $apps->url = $request->url;
            $apps->save();
            _recentAdd($apps->id, ' mengubah aplikasi', 'apps');
        } elseif ($icon == null) {
            $apps->name = $request->name;
            $apps->versi = $request->versi;
            $apps->deskripsi = $request->deskripsi;
            $apps->create_by_id = Auth::user()->id;
            $apps->url = $request->url;
            $apps->save();
            _recentAdd($apps->id, ' mengubah aplikasi', 'apps');
        }

        return redirect()->route('apps.index')->with('success', 'Apps berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apps $apps)
    {
        if ($apps->icon && Storage::disk('s3')->exists($apps->icon)) {
            Storage::disk('s3')->delete($apps->icon);
        }
        $apps->delete();

        return redirect()->route('apps.index')->with('success', 'Apps berhasil dihapus!');
    }
}

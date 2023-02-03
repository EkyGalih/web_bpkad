<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.apps.index', compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apps.add');
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
        $filename   = md5($icon->getClientOriginalName()).'.'.$icon->getClientOriginalExtension();

        if (in_array($icon->getClientOriginalExtension(), $ext)) {
            if ($icon->getSize() <= 5000000) {
                $icon->move('uploads/profile/logo_apps/', $filename);
                $request->icon = 'uploads/profile/logo_apps/'.$filename;
            }
        }

        Apps::create([
            'name' => $request->name,
            'versi' => $request->versi,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'create_by_id' => Auth::user()->id,
            'url' => $request->url
        ]);

        return redirect()->route('apps-admin.index')->with(['success' => 'Apps berhasil ditambahkan!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = Apps::findOrFail($id);

        return view('admin.apps.edit', compact('app'));
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
        $apps   = Apps::findOrFail($id);
        $icon   = $request->file('icon');

        if ($icon != null) {
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $filename   = md5($icon->getClientOriginalName()) . '.' . $icon->getClientOriginalExtension();

            if (in_array($icon->getClientOriginalExtension(), $ext)) {
                if ($icon->getSize() <= 5000000) {
                    unlink($apps->icon);
                    $icon->move('uploads/profile/logo_apps/', $filename);
                    $request->icon = 'uploads/profile/logo_apps/'.$filename;
                }
            }

            $apps->update([
                'name' => $request->name,
                'icon' => $request->icon,
                'versi' => $request->versi,
                'deskripsi' => $request->deskripsi,
                'create_by_id' => Auth::user()->id,
                'url' => $request->url
            ]);
        } elseif ($icon == null) {
            $apps->update([
                'name' => $request->name,
                'icon' => $request->icon,
                'versi' => $request->versi,
                'deskripsi' => $request->deskripsi,
                'create_by_id' => Auth::user()->id,
                'url' => $request->url
            ]);
        }

        return redirect()->route('apps-admin.index')->with(['success' => 'Apps berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $app = Apps::findOrFail($id);
        unlink($app->icon);
        $app->delete();

        return redirect()->route('apps-admin.index')->with(['success' => 'Apps berhasil dihapus!']);
    }
}

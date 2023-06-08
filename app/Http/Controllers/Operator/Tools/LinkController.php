<?php

namespace App\Http\Controllers\Operator\Tools;

use App\Http\Controllers\Controller;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if ($id != null) {
            $link = Links::findOrFail($id);
        } else {
            $link = null;
        }

        $links = Links::orderBy('created_at', 'DESC')->paginate(5);

        return view('operator.Tools.Links.index', compact('links', 'link'));
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
            'name' => 'required',
            'link' => 'required'
        ]);

        Links::create([
            'name' => $request->name,
            'link' => $request->link
        ]);

        return redirect()->back()->with(['success' => 'Link berhasil disimpan!']);
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
        $link = Links::findOrFail($id);

        $link->update([
            'name' => $request->name,
            'link' => $request->link
        ]);

        return redirect()->back()->with(['success' => 'Link berhasil diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Links::findOrFail($id);
        $link->delete();

        return redirect()->back()->with(['success' => 'Link berhasil dihapus!']);
    }
}

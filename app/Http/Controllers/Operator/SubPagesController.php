<?php

namespace App\Http\Controllers\Operator;

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

        return view('operator.pages.subpage.index', compact('subpages'));
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

        return view('operator.pages.subpage.edit', compact('pages', 'subpages'));
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
        Helpers::_recentAdd($id, 'memperbaharui halaman', 'sub_pages');

        return redirect()->route('subpages-op.index')->with(['success' => 'Sub Pages berhasil diubah!']);
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

        return redirect()->route('subpages-op.index')->with(['success' => 'Sub Pages berhasil dihapus!']);
    }
}

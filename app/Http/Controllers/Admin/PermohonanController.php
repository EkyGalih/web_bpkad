<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permohonan = Permohonan::orderBy('created_at', 'DESC')->get();

        return view('admin.faq.permohonan.index', compact('permohonan'));
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
        dd($request);
    }

    public function status($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        if ($permohonan->status == 'proses')
        {
            $permohonan->update(['status' => 'selesai']);
        }

        return redirect()->back()->with(['success' => 'Status Permohonan diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        Storage::disk('s3')->delete($permohonan->ktp);
        $permohonan->delete();

        return redirect()->back()->with(['success' => 'Permohonan dihapus!']);
    }
}

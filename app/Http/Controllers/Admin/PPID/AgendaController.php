<?php

namespace App\Http\Controllers\Admin\PPID;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Posts::AgendaKaban()->get();
        $deleted = Posts::whereDeleted()->get();

        return view('admin.ppid.agenda.index', compact('agendas', 'deleted'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Posts::AgendaKaban('tidak')->get();

        return view('admin.ppid.agenda.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function jadikanAgenda(Posts $post)
    {
        $post->agenda_kaban = 'ya';
        $post->save();

        _recentAdd($post->id, 'Menjadikan berita '.$post->title.' sebagai agenda pimpinan', 'agenda-pimpinan');
        return redirect()->route('agenda-pimpinan.index')->with('success', 'Berita berhasil dijadikan agenda pimpinan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        $post->agenda_kaban = 'tidak';
        $post->save();

        _recentAdd($post->id, 'Menghapus berita'.$post->title.' sebagai agenda pimpinan', 'agenda-pimpinan');
        return redirect()->route('agenda-pimpinan.index')->with('success', 'Berita berhasil dihapus dari agenda pimpinan');
    }
}

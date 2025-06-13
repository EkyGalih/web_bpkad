<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social = Social::select('twitter', 'facebook', 'youtube', 'instagram', 'whatsapp')->get()->last();

        return view('admin.Tools.Social.index', compact('social'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $socials = Social::get()->last();

        $social = new Social();
        $social->twitter = $request->input('twitter', $socials->twitter);
        $social->facebook = $request->input('facebook', $socials->facebook);
        $social->youtube = $request->input('youtube', $socials->youtube);
        $social->instagram = $request->input('instagram', $socials->instagram);
        $social->whatsapp = $request->input('whatsapp', $socials->whatsapp);
        $social->save();

        _recentAdd($social->id, ' mengupdate sosial media.', 'Sosial Media');

        return redirect()->back()->with(['success' => 'Sosial media berhasil disimpan!']);
    }
}

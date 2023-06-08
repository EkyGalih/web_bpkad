<?php

namespace App\Http\Controllers\Operator\Tools;

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

        return view('operator.Tools.Social.index', compact('social'));
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

        if (empty($socials)) {
            if ($request->social == 'twitter') {
                Social::create(['twitter' => $request->link]);
            } elseif ($request->social == 'facebook') {
                Social::create(['facebook' => $request->link]);
            } elseif ($request->social == 'youtube') {
                Social::create(['youtube' => $request->link]);
            } elseif ($request->social == 'instagram') {
                Social::create(['instagram' => $request->link]);
            } elseif ($request->social == 'whatsapp') {
                Social::create(['whatsapp' => $request->link]);
            }
        } else {
            $social = Social::findOrFail($socials->id);

            if ($request->social == 'twitter') {
                $social->update(['twitter' => $request->link]);
            } elseif ($request->social == 'facebook') {
                $social->update(['facebook' => $request->link]);
            } elseif ($request->social == 'youtube') {
                $social->update(['youtube' => $request->link]);
            } elseif ($request->social == 'instagram') {
                $social->update(['instagram' => $request->link]);
            } elseif ($request->social == 'whatsapp') {
                $social->update(['whatsapp' => $request->link]);
            }
        }

        return redirect()->back()->with(['success' => 'Sosial media berhasil ditambah!']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

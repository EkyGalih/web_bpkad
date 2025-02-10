<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $show = 'show';
        $active = 'active';

        return view('admin.users.profile.index', compact('user', 'show', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request, $id)
    {
        $password = User::findOrFail($id);

        if (password_verify($request->password, $password->password)) {
            $password->update([
                'password' => Hash::make($request->newpassword)
            ]);
        } else {
            return redirect()->back()->with(['fail' => 'Kata sandi sebelumnya tidak cocok dengan di database'])->withInput();
        }

        return redirect()->back()->with(['success' => 'Kata sandi berhasil diubah!']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user   = User::findOrFail($id);
        $social = Social::where('user_id', '=', $id)->first();

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        $social->update([
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp
        ]);

        Helpers::_recentAdd($id, 'memperbaharui profilenya', 'users');

        return redirect()->back()->with(['success' => 'Perubahan berhasil disimpan']);
    }
}

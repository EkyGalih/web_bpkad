<?php

namespace App\Http\Controllers\Operator;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

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

        return view('operator.profile.index', compact('user', 'show', 'active'));
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

        if ($request->file('foto') != NULL) {
            $foto       = $request->file('foto');
            $ext        = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
            $filename   = 'profile-' . md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();
            $id         = (string)Uuid::generate(4);

            if (in_array($foto->getClientOriginalExtension(), $ext)) {
                if ($foto->getSize() <= 5000000) {
                    $foto->move('upload/profile/',  $filename);
                    $request->foto = 'upload/profile/' . $filename;
                }
            }
        }

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'avatar' => $request->foto
        ]);

        if ($social != NULL) {
            $social->update([
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'whatsapp' => $request->whatsapp
            ]);
        }

        Helpers::_recentAdd($id, 'memperbaharui profilenya', 'users');

        return redirect()->back()->with(['success' => 'Perubahan berhasil disimpan']);
    }
}

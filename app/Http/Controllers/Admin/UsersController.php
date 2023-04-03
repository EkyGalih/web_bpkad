<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('deleted_at', '=', NULL)->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.components.create');
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
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $id = (string)Uuid::generate(4);

        User::create([
            'id' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'active' => '0',
            'avatar' => '/static/uploads/profile/favicon.png',
            'role' => $request->role,
            'password' => Hash::make($request->paassword)
        ]);

        Helpers::_recentAdd($id, 'menambahkan user', 'users');

        return redirect()->route('users')->with(['success' => 'User Berhasil Ditambahkan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.components.edit', compact('user'));
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
        $user = User::findOrFail($id);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        Helpers::_recentAdd($id, 'mengubah user', 'users');

        return redirect()->route('users')->with(['success' => 'Perubahan User Berhasil Disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'deleted_at' => new DateTime()
        ]);
        Helpers::_recentAdd($id, 'menghapus user', 'users');

        return redirect()->back()->with(['success' => 'User berhasil dihapus!']);
    }
}

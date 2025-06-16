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
        $users = User::where('deleted_at', '=', NULL)->orderByDesc('created_at')->get();

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
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'role.required' => 'Role wajib dipilih.',
            'role.string' => 'Role harus berupa teks.',
        ]);

        $user = new User();

        $user->id = (string)Uuid::generate(4);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->active = '0';
        $user->avatar = '/server/assets/img/avatars/13.png';
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        _recentAdd($user->id, 'menambahkan user', 'users');

        return redirect()->route('users')->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('admin.users.components.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        _recentAdd($user->id, ' mengubah user', 'users');

        return redirect()->route('users')->with('success', 'Perubahan User Berhasil Disimpan');
    }

    public function password(Request $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        _recentAdd($user->id, ' mengubah password', 'users');

        return redirect()->route('users')->with('success', 'Password berhasil diubah!');
    }

    public function activated(User $user)
    {
        if ($user->active == "0") {
            $user->update([
                'active' => "1"
            ]);
            return redirect()->route('users')->with('success', 'User di aktifkan!');
        } else {
            $user->update([
                'active' => "0"
            ]);
            return redirect()->route('users')->with('success', 'User di nonaktifkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->update([
            'deleted_at' => new DateTime()
        ]);
        _recentAdd($user->id, ' menghapus user', 'users');

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}

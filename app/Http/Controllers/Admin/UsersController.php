<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Rule;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\RichText\Run;
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
        $pegawais = Pegawai::orderBy('name', 'asc')->get();
        return view('admin.users.components.create', compact('pegawais'));
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
            'pegawai_id' => 'required',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ], [
            'pegawai_id.required' => 'Nama wajib diisi.',
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
        $role = new Rule();

        $user->id = (string)Uuid::generate(4);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->active = '0';
        $user->pegawai_id = $request->pegawai_id;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        $role->user_id = $user->id;
        $role->apps_id = '22100703-cc14-4177-8bed-305664c5e698';
        $role->rule = $user->role;
        $role->save();

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
        $pegawais = Pegawai::orderBy('name', 'asc')->get();
        return view('admin.users.components.edit', compact('user', 'pegawais'));
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
            'pegawai_id' => $request->pegawai_id,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        $role = Rule::where('user_id', $user->id)->first();
        $role->update([
            'rule' => $request->role
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

    public function getPegawai($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json(['error' => 'Pegawai tidak ditemukan'], 404);
        }

        if ($pegawai->nip != 0) {
            $username = $pegawai->nip;
        } else {
            $username = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
        }

        return response()->json([
            'nama' => $pegawai->name,
            'username' => $username,
            'email' => $pegawai->email ?? '',
        ]);
    }
}

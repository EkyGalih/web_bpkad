<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User as RequestsUser;
use App\Models\Rule;
use App\Models\User as Users;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class ManajemenUserController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->all()) {
            $search = $request->get('search');
            $users = Users::where('nama', 'like', '%' . $search . '%')->orderBy('nama')->paginate(10);
            return view('auth.user', compact('users', 'search'));
        }
        $users = Users::orderBy('nama')->paginate(10);
        return view('auth.user', compact('users'));
    }

    
    public function create()
    {
        return view('auth.tambah');
    }

    
    public function store(RequestsUser $request)
    {
        $uuid = (string)Uuid::generate(4);
        Users::create([
            'id' => $uuid,
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar' => Avatar::create($request->nama),
            'active' => '1',
        ]);
        Rule::create([
            'nama_rule' => $request->nama_rule,
            'aplikasi' => $request->aplikasi,
            'user_id' => $uuid,
        ]);
        return redirect()->route('pengguna')->with(['success' => 'Pengguna berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = Users::findOrFail($id);
        $rules = DB::table('rule')
            ->where('user_id', '=', $id)
            ->get();
        return view('auth.user-detail', compact('users', 'rules'));
    }

    
    public function edit($id)
    {
        $users = Users::findOrFail($id);
        return view('auth.tambah', compact('users'));
    }

    
    public function update(Request $request, $id)
    {
        $users = Users::findOrFail($id);
        $users->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
        ]);
        return redirect()->route('pengguna')->with(['success' => 'Data pengguna berhasil diubah!']);
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

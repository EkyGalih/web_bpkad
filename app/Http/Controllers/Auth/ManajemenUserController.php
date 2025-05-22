<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User as RequestsUser;
use App\Models\Apps;
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
        $apps = Apps::get();
        return view('auth.tambah', compact('apps'));
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

        foreach ($request->aplikasi as $value) {
            Rule::create([
                'user_id' => $uuid,
                'apps_id' => $value,
                'rule' => $request->nama_rule,
            ]);
        }

        Helpers::_recentAdd($uuid, 'menambahkan user', 'users');

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
        $rules = Rule::where('user_id', '=', $id)
            ->get();
        return view('auth.user-detail', compact('users', 'rules'));
    }


    public function edit($id)
    {
        $users = Users::findOrFail($id);
        $apps = Apps::get();

        return view('auth.ubah', compact('users','apps'));
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

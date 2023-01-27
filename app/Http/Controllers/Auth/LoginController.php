<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'profile', 'resetPassword', 'doResetPassword', 'edit', 'update']);
    }

    // tampilkan view login

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // dd(Hash::make('bpk4dntb'));
        $validation = $request->validated();

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
        }else{
            $credentials = [
                'username' => $request->email,
                'password' => $request->password,
            ];
        }

        $user = User::where('username', '=', $request->email)->orWhere('email', '=', $request->email)->first();

        if($user) {
            if($user->active == '0') {
                return redirect()->back()
                ->with(['failed' => 'Mohon Maaf, akun anda telah di tangguhkan, silahkan menghubungi operator kami untuk pemulihan akun!'])
                ->withInput($request->all());
            }
        }

        if (Auth::attempt($credentials, $request->remember_me)) {
            return redirect()->route('sso.dashboard');
        }

        return redirect()->back()->with(['failed' => 'Login gagal, pastikan username dan password anda benar'])->withInput($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form')->with(['success' => 'Anda telah logout!']);
    }
}

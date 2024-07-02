<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
        $validation = $request->validated();

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
        } else {
            $credentials = [
                'username' => $request->email,
                'password' => $request->password,
            ];
        }

        $user = User::where('username', '=', $request->email)->orWhere('email', '=', $request->email)->first();

        if ($user) {
            if ($user->active == '0') {
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

    public function login_google()
    {
        return view('auth.login_google');
    }

    // login via google

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', '=', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != NULL) {
                auth()->login($user, true);
                return redirect()->back();
            } else {
                $create = User::create([
                    'email' => $user_google->getEmail(),
                    'username' => $user_google->getEmail(),
                    'nama' => $user_google->getName(),
                    'password' => 0,
                    'email_verified_at' => now(),
                    'avatar' => $user_google->getAvatar(),
                    'active' => '1',
                    'role' => 'user'
                ]);

                auth()->login($create, true);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}

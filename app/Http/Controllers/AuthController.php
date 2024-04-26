<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityController;

class AuthController extends HelpController
{
    protected $data;

    public function __construct(Request $request)
    {
    }
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->is_admin) {
                return redirect()->intended('/books')->with('status', 'success/Log In/Log In Berhasil!');
            }

            return redirect()->intended('/books')->with('status', 'success/Log In/Log In Berhasil!');
        }

        if (session()->has('status')) {
            AlertController::alert(session('status'));
        }

        return view('Auth.login');
    }

    public function authenticate(Request $request)
    {
        $attr = Str::of(":attribute")->headline();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            "email.required" => $attr . " harus diisi!",
            "password.required" => $attr . " harus diisi!",
        ]);

        $remember = $request->get("remember");

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->status !== 'A') {
                return redirect('')->with('status', 'error/Log In Gagal!/Akun belum aktif, Segera hubungi Administrator!')->withInput($credentials);
            }
        }

        if (Auth::attempt($credentials, $remember)) {

            $token = $user->createToken($user->email)->plainTextToken;

            $request->session()->put("token", $token);
            $request->session()->regenerate();

            if (!ActivityController::create('users', type: 'sign-in', desc: 'Sign in')) {
                return redirect(url('/users'))->with('status', 'failed/Gagal/Mencatat aktifitas gagal!');
            }

            if ($this->isAdmin()) {
                return redirect()->intended('/dashboard')->with('status', 'success/Log In/Log In Berhasil!');
            }

            return redirect()->intended('/customer')->with('status', 'success/Log In/Log In Berhasil!');
        }

        return back()->with('status', 'error/Log In/Log In Gagal!')->withInput($credentials);
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'success/Log Out/Log Out Berhasil!');
    }
}

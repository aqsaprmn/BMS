<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AlertController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function resetPassword()
    {
        if (auth()->check()) {
            if (auth()->user()->is_admin) {
                return redirect()->intended('/dashboard')->with('status', 'success/Log In/Log In Berhasil!');
            }

            return redirect()->intended('/customer')->with('status', 'success/Log In/Log In Berhasil!');
        }

        if (session()->has('status')) {
            AlertController::alert(session('status'));
        }

        return view('Auth.passwords.email');
    }

    public function sendEmailLink(Request $request)
    {
        $attr = Str::of(":attribute")->headline();

        $request->validate(['email' => 'required|email:dns'], [
            "email.required" => $attr . " harus diisi!",
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('/')->with('status', "success/Send Reset Pasword/Kirim link reset pasword berhasil")
            : back()->withErrors(['email' => "Kirim link reset password gagal " . __($status)]);
    }

    public function resetView($token, Request $request)
    {
        $email = $request->get("email");
        return view('Auth.passwords.reset', ['token' => $token, "email" => $email]);
    }

    public function resetProcess(Request $request)
    {
        $attr = Str::of(":attribute")->headline();

        $request->validate([
            'token' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:5|confirmed',
        ], [
            "email.required" => $attr . " harus diisi!",
            "password.required" => $attr . " harus diisi!",
            "password.min" => $attr . " minimal harus berisi 5 karakter!",
            "password.confirmed" => $attr . " tidak sesuai dengan konfirmasi!",
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        $errMsg = __($status) == "passwords.token" ? "token tidak diketahui!" : __($status);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('/')->with('status', "success/Reset Password/Proses reset password berhasil.")
            : back()->withErrors(['email' => ["Proses reset password gagal " . $errMsg]]);
    }
}

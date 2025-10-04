<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (!auth()->guest())
            return redirect()->route('index');

        return view('auth.login');
    }

    public function login_store(Request $request)
    {
        $credentials = $request->validate([
            'officer_id' => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            if (!$user->two_factor_status || $user->two_factor_secret == '') {
                $request->session()->regenerate();
                $user = Auth::user();
                $user->last_login = now();
                $user->update();
                return redirect()->route('index');
            } else {
                Auth::logout();
                $request->session()->put('usr', $user);
                $request->session()->put('usr_attempt', 0);
                return redirect()->route('login_2fa');
            }
        }

        return back()->withErrors([
            'officer_id' => 'รหัสพนักงานไม่ถูกต้อง',
        ])->onlyInput('officer_id');
    }

    public function login_2fa(Request $request)
    {
        $user = $request->session()->get('usr');
        if ($user == null)
            return redirect()->route('login');

        if (!auth()->guest())
            return redirect()->route('index');

        return view('auth.2fa');
    }

    public function login_2fa_store(Request $request)
    {
        $request->validate([
            'secret_code' => 'required|numeric|digits:6'
        ], [
            'secret_code.required' => 'โปรดกรอกรหัสความปลอดภัย',
            'secret_code.numeric' => 'รหัสต้องเป็นตัวเลขเท่านั้น',
            'secret_code.digits' => 'รหัสต้องมี 6 หลักเท่านั้น'
        ]);

        if ($request->session()->has('usr')) {
            $google2fa = app('pragmarx.google2fa');
            $user = $request->session()->get('usr');
            $valid = $google2fa->verifyKey($user->two_factor_secret, $request->secret_code);
            if ($valid) {
                Auth::login($user, false);
                return redirect()->route('index');
            } else {
                $_attempt = $request->session()->get('usr_attempt');
                if ($_attempt >= 2) {
                    Auth::logout();
                    $request->session()->regenerate();
                    return redirect()->route('login')->with('error', 'รหัสความปลอดภัยไม่ถูกต้อง');
                }
                $request->session()->put('usr_attempt', $_attempt + 1);
                return back()->withErrors([
                    'secret_code' => 'รหัสความปลอดภัยไม่ถูกต้อง',
                ])->onlyInput('secret_code');
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'คุณกรอกรหัสความปลอดภัยไม่ถูกต้อง',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

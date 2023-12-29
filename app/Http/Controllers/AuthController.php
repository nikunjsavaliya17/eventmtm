<?php

namespace App\Http\Controllers;

use App\Events\ResetPasswordMailEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function login(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->user();
            if ($user->is_active == 0) {
                Auth::logout();
                return redirect()->back()->with('error', "Your account not activate.");
            }
            return to_route('dashboard');
        } else {
            return redirect()->back()->with('error', "Invalid Credentials!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function forgotPassword(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.forgot_password');
    }

    public function sendResetPasswordLink(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (isset($user)) {
                DB::transaction(function () use ($user) {
                    $token = Str::random(25);
                    DB::table('password_reset_tokens')->insert([
                        'email' => $user->email,
                        'token' => $token,
                        'created_at' => Carbon::now(),
                    ]);
                    $emailData = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'reset_url' => route('reset_password_link', $token),
                    ];
                    event(new ResetPasswordMailEvent($emailData));
                });
                return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
            }
            return redirect()->back()->with('error', 'User not exists');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function resetPassword($token): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $recordExist = DB::table('password_reset_tokens')->where(['token' => $token])->first();
        if ($recordExist) {
            return view('auth.reset_password', compact('token', 'recordExist'));
        } else {
            return to_route('login')->with('error', 'Link Expired');
        }
    }
}

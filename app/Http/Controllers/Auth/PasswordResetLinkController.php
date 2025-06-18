<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __(Password::RESET_LINK_SENT)]);
        }

        $token = Password::broker()->createToken($user);

        return back()->with([
            'status' => 'Password reset link generated',
            'reset_link' => route('password.reset', [
                'token' => $token,
                'email' => $user->email
            ]),
            'expires_at' => now()->addMinutes(
                config('auth.passwords.users.expire')
            )->format('Y-m-d H:i:s')
        ]);
    }
}


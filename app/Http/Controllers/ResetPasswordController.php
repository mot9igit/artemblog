<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function showResetForm(string $token = null): View
    {
        return view('auth.reset-password')->with(['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->password = $password;
                $user->save();

                Auth::login($user);
            }
        );

        if($status == Password::PASSWORD_RESET){
            return redirect()->route('admin.posts.index')->with('status', __($status));
        }

        return back()->with('status', __($status));
    }
}

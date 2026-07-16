<?php

namespace App\Presentation\Controllers\Web;
use App\Presentation\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthController
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => 'Авторизация успешна',
                'redirect' => redirect()->intended('/profile')->getTargetUrl()
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'Неверные данные'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }

    public function profile(): RedirectResponse | View
    {
        if(Auth::check()){
            return redirect()->route('front.profile.index');
        }else{
            return view('auth.auth');
        }
    }
}

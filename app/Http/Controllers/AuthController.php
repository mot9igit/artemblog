<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ){}

    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse{
        $this->authService->register($request->validated());
        $this->authService->attemptLogin($request->email, $request->password);
        $request->session()->regenerate();
        return redirect()->route('admin.posts.index');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $valid = $request->validated();

        if(!$this->authService->attemptLogin($valid['email'], $valid['password'], (bool) ($valid['remember_me'] ?? false))){
            return back()->withErrors([
                'email' => "Неверная почта или пароль"
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.posts.index'))->with("status", "С возвращением!");
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect()->route('login')->with("status", "Вы вышли из аккаунта!");
    }

}

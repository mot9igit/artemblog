<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {}

    public function register(array $data): User
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    public function attemptLogin(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}

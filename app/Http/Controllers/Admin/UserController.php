<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService,
    ){}

    public function index(Request $request): View
    {
        $users = $this->userService->getAdminPaginated($request->input('search'), 10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $role = UserRole::from($request->input('role'));
        $this->userService->changeRole($user->id, $role);
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлен!');
    }

}

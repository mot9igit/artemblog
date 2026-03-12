<?php

namespace App\Services\Interfaces;

use App\Enums\UserRole;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function changeRole(int $id, UserRole $role): bool;

    public function getAdminPaginated(string $search, int $perPage): LengthAwarePaginator;
}

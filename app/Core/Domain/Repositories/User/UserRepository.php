<?php

namespace App\Core\Domain\Repositories\User;

use App\Core\Domain\Dto\User\UpdateUserDto;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginationParamsValueObject;

interface UserRepository
{
    public function create(UserEntity $entity): UserEntity;
    public function findById(string $id): UserEntity|null;
    public function findByEmail(string $email): UserEntity|null;
    public function findByResetPasswordToken(string $token) : UserEntity|null;
    public function findAll(
        UserFiltersValueObject $filters,
        PaginationParamsValueObject $pagination
    ): PaginatedResultValueObject;

    public function update(string $id, UpdateUserDto $dto): UserEntity|null;
    public function delete(string $id): bool;
}

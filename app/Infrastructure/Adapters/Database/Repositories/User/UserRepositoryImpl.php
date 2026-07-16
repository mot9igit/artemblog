<?php

namespace App\Infrastructure\Adapters\Database\Repositories\User;

use App\Core\Domain\Dto\User\UpdateUserDto;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginationParamsValueObject;
use App\Infrastructure\Adapters\Database\Builders\UserBuilder;
use App\Infrastructure\Adapters\Database\Mappers\UserMapper;
use App\Infrastructure\Adapters\Database\Models\User;

class UserRepositoryImpl implements UserRepository
{
    public function create(UserEntity $entity): UserEntity
    {
        $data = UserMapper::toPersistence($entity);
        $createdModel = User::query()->create($data);
        return UserMapper::toEntity($createdModel);
    }

    public function findById(string $id): UserEntity|null
    {
        $record = User::query()->find($id);
        if (!$record) {
            return null;
        }
        return UserMapper::toEntity($record);
    }

    public function findByEmail(string $email): UserEntity|null
    {
        $record = User::query()->where('email', $email)->first();
        if (!$record) {
            return null;
        }
        return UserMapper::toEntity($record);
    }

    public function findByResetPasswordToken(string $token): UserEntity|null
    {
        $record = User::query()->where('reset_password_token', $token)->first();
        if (!$record) return null;

        return UserMapper::toEntity($record);
    }

    public function findAll(
        UserFiltersValueObject $filters,
        PaginationParamsValueObject $pagination
    ): PaginatedResultValueObject {
        $query = User::query();

        UserBuilder::build($query, $filters);

        $paginator = $query->paginate(
            perPage: $pagination->take(),
            page: $pagination->page
        );

        $entities = $paginator->getCollection()
            ->map(fn($model) => UserMapper::toEntity($model))
            ->toArray();

        return new PaginatedResultValueObject(
            $entities,
            $paginator->total(),
            $pagination
        );
    }

    public function update(string $id, UpdateUserDto $dto): UserEntity|null
    {
        $record = User::query()->find($id);
        if (!$record) {
            return null;
        }

        $data = UserMapper::toUpdatePersistence($dto);

        $record->update($data);
        $record->refresh();

        return UserMapper::toEntity($record);
    }

    public function delete(string $id): bool
    {
        return (bool) User::query()->where('id', $id)->delete();
    }
}

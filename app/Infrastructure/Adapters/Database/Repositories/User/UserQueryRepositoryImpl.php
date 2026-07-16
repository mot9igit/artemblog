<?php

namespace App\Infrastructure\Adapters\Database\Repositories\User;

use App\Core\Domain\Aggregates\UserAggregate;
use App\Core\Domain\Repositories\User\UserQueryRepository;
use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginationParamsValueObject;
use App\Infrastructure\Adapters\Database\Builders\UserBuilder;
use App\Infrastructure\Adapters\Database\Mappers\UserMapper;
use App\Infrastructure\Adapters\Database\Models\User;

class UserQueryRepositoryImpl implements UserQueryRepository
{
    public function findById(string $id): UserAggregate|null
    {
        $record = User::query()->find($id);

        if (!$record) {
            return null;
        }

        $user = UserMapper::toEntity($record);

        return new UserAggregate($user);
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

        $aggregates = $paginator->getCollection()
            ->map(fn($model) => new UserAggregate(UserMapper::toEntity($model)))
            ->toArray();

        return new PaginatedResultValueObject(
            $aggregates,
            $paginator->total(),
            $pagination
        );
    }
}

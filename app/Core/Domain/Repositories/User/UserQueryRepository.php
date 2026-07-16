<?php

namespace App\Core\Domain\Repositories\User;

use App\Core\Domain\Aggregates\UserAggregate;
use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginationParamsValueObject;

interface UserQueryRepository
{
    public function findById(string $id): UserAggregate|null;
    public function findAll(
        UserFiltersValueObject $filters,
        PaginationParamsValueObject $pagination
    ): PaginatedResultValueObject;
}

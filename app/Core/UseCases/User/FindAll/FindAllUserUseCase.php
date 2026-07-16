<?php

namespace App\Core\UseCases\User\FindAll;

use App\Core\Domain\Repositories\User\UserQueryRepository;
use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Core\Domain\ValueObjects\Shared\PaginationParamsValueObject;

readonly class FindAllUserUseCase
{
    public function __construct(
        private UserQueryRepository $userQueryRepository,
    ) {}

    public function execute(FindAllUserCommand $command): PaginatedResultValueObject
    {
        $params = new UserFiltersValueObject(
            search: $command->search,
            name: $command->name,
            email: $command->email,
            active: $command->active,
        );

        $pagination = new PaginationParamsValueObject($command->page ?? 1, $command->limit ?? 20);

        return $this->userQueryRepository->findAll($params, $pagination);
    }
}

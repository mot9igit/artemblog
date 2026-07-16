<?php

namespace App\Core\UseCases\User\FindById;

use App\Core\Domain\Aggregates\UserAggregate;
use App\Core\Domain\Repositories\User\UserQueryRepository;

readonly class FindByIdUserUseCase
{
    public function __construct(
        private UserQueryRepository $userQueryRepository,
    ) {}

    public function execute(FindByIdUserCommand $command): ?UserAggregate
    {
        return $this->userQueryRepository->findById($command->id);
    }
}

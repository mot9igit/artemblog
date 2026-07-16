<?php

namespace App\Core\UseCases\User\Delete;

use App\Core\Domain\Repositories\User\UserRepository;

class DeleteUserUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    public function execute(DeleteUserCommand $command): bool
    {
        return $this->userRepository->delete($command->id);
    }
}

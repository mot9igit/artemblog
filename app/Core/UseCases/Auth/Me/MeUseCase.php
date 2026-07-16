<?php

namespace App\Core\UseCases\Auth\Me;

use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Exceptions\User\UserNotFoundByEmailException;
use App\Core\Domain\Repositories\User\UserRepository;

readonly class MeUseCase
{
    public function __construct(
        private UserRepository $userRepository,
    ) {}

    public function execute(MeCommand $command): UserEntity
    {
        $user = $this->userRepository->findById($command->userId);
        if (!$user) {
            throw new UserNotFoundByEmailException($command->userId);
        }
        return $user;
    }
}

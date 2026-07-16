<?php


namespace App\Core\UseCases\User\CompleteResetPassword;

use App\Core\Domain\Dto\User\UpdateUserDto;
use App\Core\Domain\Exceptions\User\UserNotFoundByTokenException;
use App\Core\Domain\Repositories\User\UserRepository;

readonly class CompleteResetPasswordUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {
    }

    public function execute(CompleteResetPasswordUserCommand $command): void
    {
        $user = $this->userRepository->findByResetPasswordToken($command->token);
        if (!$user) {
            throw new UserNotFoundByTokenException();
        }

        $dto = new UpdateUserDto(
            password: $command->newPassword,
            resetPasswordToken: null
        );

        $this->userRepository->update($user->id, $dto);
    }
}

<?php


namespace App\Core\UseCases\User\ResetPassword;

use App\Core\Domain\Dto\User\UpdateUserDto;
use App\Core\Domain\Exceptions\User\UserNotFoundByEmailException;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Ports\Shared\MailPort;
use Illuminate\Support\Str;

readonly class ResetPasswordUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private MailPort $mailPort
    )
    {}

    public function execute(ResetPasswordUserCommand $command): void
    {
        $user = $this->userRepository->findByEmail($command->email);
        if (!$user) {
            throw new UserNotFoundByEmailException($command->email);
        }

        $token = Str::uuid()->toString();
        $dto = new UpdateUserDto(
            resetPasswordToken: $token,
        );

        $this->userRepository->update($user->id, $dto);

        $this->mailPort->send(
            'artpetropavlovskij@gmail.com',
            'Сброс пароля',
            'emails.reset-password',
            ['data' => ['token' => $token]]
        );
    }
}

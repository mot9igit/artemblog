<?php

namespace App\Core\UseCases\Auth\ApiLogin;

use App\Core\Domain\Exceptions\User\InvalidPasswordException;
use App\Core\Domain\Exceptions\User\UserNotFoundByEmailException;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Ports\Auth\TokenGeneratorPort;
use App\Core\Ports\Shared\PasswordHasherPort;

readonly class ApiLoginUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasherPort $passwordHasher,
        private TokenGeneratorPort $tokenGenerator,
    )
    {
    }

    public function execute(ApiLoginCommand $command): ApiLoginResult
    {
        $user = $this->userRepository->findByEmail($command->email);
        if (!$user) {
            throw new UserNotFoundByEmailException($command->email);
        }

        $isValidPassword = $this->passwordHasher->verify($user->password, $command->password);

        if(!$isValidPassword) {
            throw new InvalidPasswordException();
        }

        $token = $this->tokenGenerator->create($user, 'api_token');

        return new ApiLoginResult(
            user: $user,
            token: $token,
        );
    }
}

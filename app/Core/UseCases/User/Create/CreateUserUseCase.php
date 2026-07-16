<?php

namespace App\Core\UseCases\User\Create;

use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Enums\User\Role;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Domain\Services\Storage\StorageProcessService;
use App\Core\Domain\ValueObjects\Shared\UUIDValueObject;
use App\Core\Ports\Storage\StoragePort;

readonly class CreateUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private StoragePort    $storagePort,
    ) {}

    public function execute(CreateUserCommand $command): UserEntity
    {
        $avatarPath = null;

        if ($command->avatar) {
            $upload = StorageProcessService::create($command->avatar, 'users/avatars');
            $this->storagePort->save($upload->input);
            $avatarPath = $upload->key;
        }

        $entity = new UserEntity(
            id: UUIDValueObject::generate()->value(),
            name: $command->name,
            email: $command->email,
            phone: $command->phone,
            fullname: $command->fullname,
            password: $command->password,
            active: $command->active,
            sudo: $command->sudo,
            avatar: $avatarPath,
            resetPasswordToken: null,
            roles: [Role::USER]
        );

        return $this->userRepository->create($entity);
    }
}

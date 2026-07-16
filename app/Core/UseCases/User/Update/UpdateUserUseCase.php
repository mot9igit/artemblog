<?php

namespace App\Core\UseCases\User\Update;

use App\Core\Domain\Dto\User\UpdateUserDto as DomainUpdateDto;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Domain\Services\Storage\StorageProcessService;
use App\Core\Domain\ValueObjects\Modules\File\FileValueObject;
use App\Core\Ports\Storage\StoragePort;

readonly class UpdateUserUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private StoragePort    $storagePort,
    ) {}

    public function execute(string $id, UpdateUserCommand $command): ?UserEntity
    {
        $existing = $this->userRepository->findById($id);
        if (!$existing) {
            return null;
        }

        $avatarPath = null;
        if ($command->avatar !== null) {
            if ($command->avatar instanceof FileValueObject && $command->avatar->buffer !== '') {
                if ($existing->avatar) {
                    $this->storagePort->remove($existing->avatar);
                }
                $upload = StorageProcessService::create($command->avatar, 'users/avatars');
                $this->storagePort->save($upload->input);
                $avatarPath = $upload->key;
            } elseif (is_string($command->avatar)) {
                $avatarPath = $command->avatar;
            }
        }

        $domainUpdateDto = new DomainUpdateDto(
            name: $command->name,
            email: $command->email,
            phone: $command->phone,
            fullname: $command->fullname,
            password: $command->password,
            avatar: $avatarPath,
            active: $command->active,
            sudo: $command->sudo,
            properties: $command->properties,
        );

        return $this->userRepository->update($id, $domainUpdateDto);
    }
}

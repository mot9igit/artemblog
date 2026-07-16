<?php

namespace App\Infrastructure\Adapters\Database\Mappers;

use App\Core\Domain\Dto\User\UpdateUserDto;
use App\Core\Domain\Entities\UserEntity;
use App\Infrastructure\Adapters\Database\Models\User;

class UserMapper
{
    public static function toEntity(User $model): UserEntity
    {
        return new UserEntity(
            id: $model->getAttributeValue('id'),
            name: $model->getAttributeValue('name'),
            email: $model->getAttributeValue('email'),
            phone: $model->getAttributeValue('phone'),
            fullname: $model->getAttributeValue('fullname'),
            password: $model->getAttributeValue('password'),
            active: $model->getAttributeValue('active'),
            sudo: $model->getAttributeValue('sudo'),
            avatar: $model->getAttributeValue('avatar'),
            resetPasswordToken: $model->getAttributeValue('reset_password_token'),
            roles: $model->getAttributeValue('roles') ?? [],
        );
    }

    public static function toPersistence(UserEntity $entity): array
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'email' => $entity->email,
            'phone' => $entity->phone,
            'fullname' => $entity->fullname,
            'password' => $entity->password,
            'active' => $entity->active,
            'sudo' => $entity->sudo,
            'avatar' => $entity->avatar,
            'reset_password_token' => $entity->resetPasswordToken,
            'roles' => $entity->roles
        ];
    }

    public static function toUpdatePersistence(UpdateUserDto $dto): array
    {
        $result = [];
        if ($dto->name !== null) $result['name'] = $dto->name;
        if ($dto->email !== null) $result['email'] = $dto->email;
        if ($dto->phone !== null) $result['phone'] = $dto->phone;
        if ($dto->fullname !== null) $result['fullname'] = $dto->fullname;
        if ($dto->password !== null) $result['password'] = $dto->password;
        if ($dto->avatar !== null) $result['avatar'] = $dto->avatar;
        if ($dto->active !== null) $result['active'] = $dto->active;
        if ($dto->sudo !== null) $result['sudo'] = $dto->sudo;
        if ($dto->resetPasswordToken !== null) $result['reset_password_token'] = $dto->resetPasswordToken;
        if ($dto->roles) $result['roles'] = $dto->roles;
        if ($dto->properties !== null) $result['properties'] = $dto->properties;

        return $result;
    }
}

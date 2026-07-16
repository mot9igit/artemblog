<?php

namespace App\Presentation\Mappers;

use App\Core\Domain\Aggregates\UserAggregate;
use App\Core\Domain\Dto\User\UpdateUserDto as DomainUpdateUserDto;
use App\Core\Domain\Entities\UserEntity;
use App\Core\Domain\ValueObjects\Modules\File\FileValueObject;
use App\Core\Ports\Storage\StoragePort;
use App\Core\UseCases\User\CompleteResetPassword\CompleteResetPasswordUserCommand;
use App\Core\UseCases\User\Create\CreateUserCommand;
use App\Core\UseCases\User\Delete\DeleteUserCommand;
use App\Core\UseCases\User\FindAll\FindAllUserCommand;
use App\Core\UseCases\User\FindById\FindByIdUserCommand;
use App\Core\UseCases\User\ResetPassword\ResetPasswordUserCommand;
use App\Core\UseCases\User\Update\UpdateUserCommand;
use App\Presentation\Dto\User\ResponseUserDto;
use App\Presentation\Dto\User\ResponseUserProfileDto;
use App\Presentation\Requests\User\CompleteResetPasswordUserRequest;
use App\Presentation\Requests\User\CreateUserRequest;
use App\Presentation\Requests\User\FindAllUserRequest;
use App\Presentation\Requests\User\ResetPasswordUserRequest;
use App\Presentation\Requests\User\UpdateUserRequest;

class UserMapper
{
    public static function toCreateCommand(CreateUserRequest $request): CreateUserCommand
    {
        $avatarVO = null;
        if ($request->file('avatar')) {
            $avatarVO = new FileValueObject(
                $request->file('avatar')->getContent(),
                $request->file('avatar')->getMimeType(),
                $request->file('avatar')->getClientOriginalName(),
            );
        }

        return new CreateUserCommand(
            name: $request->validated('name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            fullname: $request->validated('fullname'),
            password: $request->validated('password'),
            avatar: $avatarVO,
            active: (bool) $request->validated('active', false),
            sudo: (bool) $request->validated('sudo', false)
        );
    }

    public static function toDomainUpdateDto(UpdateUserRequest $request): DomainUpdateUserDto
    {
        $avatarVO = null;
        if ($request->file('avatar')) {
            $avatarVO = new FileValueObject(
                $request->file('avatar')->getContent(),
                $request->file('avatar')->getMimeType(),
                $request->file('avatar')->getClientOriginalName(),
            );
        }

        return new DomainUpdateUserDto(
            name: $request->validated('name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            fullname: $request->validated('fullname'),
            password: $request->validated('password'),
            avatar: $avatarVO,
            active: $request->has('active') ? (bool) $request->validated('active') : null,
            sudo: $request->has('sudo') ? (bool) $request->validated('sudo') : null
        );
    }

    public static function toUpdateCommand(UpdateUserRequest $request): UpdateUserCommand
    {
        $avatar = null;
        if ($request->file('avatar')) {
            $avatar = new FileValueObject(
                $request->file('avatar')->getContent(),
                $request->file('avatar')->getMimeType(),
                $request->file('avatar')->getClientOriginalName(),
            );
        } elseif ($request->validated('avatar')) {
            $avatar = $request->validated('avatar');
        }

        return new UpdateUserCommand(
            name: $request->validated('name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            fullname: $request->validated('fullname'),
            password: $request->validated('password'),
            avatar: $avatar,
            active: $request->has('active') ? (bool) $request->validated('active') : null,
            sudo: $request->has('sudo') ? (bool) $request->validated('sudo') : null
        );
    }

    public static function toResetPasswordCommand(ResetPasswordUserRequest $request): ResetPasswordUserCommand
    {
        return new ResetPasswordUserCommand(email: $request->validated('email'));
    }

    public static function toCompleteResetPasswordCommand(CompleteResetPasswordUserRequest $request): CompleteResetPasswordUserCommand
    {
        return new CompleteResetPasswordUserCommand(token: $request->validated('token'), newPassword: $request->validated('password'));
    }

    public static function toFindAllCommand(FindAllUserRequest $request): FindAllUserCommand
    {
        return new FindAllUserCommand(
            search: $request->validated('search'),
            name: $request->validated('name'),
            email: $request->validated('email'),
            active: $request->has('active') ? (bool) $request->validated('active') : null,
            page: $request->validated('page', 1),
            limit: $request->validated('limit', 20)
        );
    }

    public static function toFindByIdCommand(string $id): FindByIdUserCommand
    {
        return new FindByIdUserCommand(id: $id);
    }

    public static function toDeleteCommand(string $id): DeleteUserCommand
    {
        return new DeleteUserCommand(id: $id);
    }

    public static function toResponse(UserEntity $entity, StoragePort $storagePort): ResponseUserDto
    {
        $avatarUrl = $entity->avatar ? $storagePort->get($entity->avatar) : null;

        return new ResponseUserDto(
            id: $entity->id,
            name: $entity->name,
            email: $entity->email,
            phone: $entity->phone,
            fullname: $entity->fullname,
            active: $entity->active,
            sudo: $entity->sudo,
            avatar: $avatarUrl
        );
    }

    public static function toResponseFromAggregate(UserAggregate $aggregate, StoragePort $storagePort): ResponseUserDto
    {
        $user = $aggregate->userEntity;
        $avatarUrl = $user->avatar ? $storagePort->get($user->avatar) : null;

        return new ResponseUserDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            phone: $user->phone,
            fullname: $user->fullname,
            active: $user->active,
            sudo: $user->sudo,
            avatar: $avatarUrl
        );
    }

    public static function toResponseProfile(UserEntity $user, StoragePort $storagePort): ResponseUserProfileDto
    {
        $avatarUrl = $user->avatar ? $storagePort->get($user->avatar) : null;

        return new ResponseUserProfileDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            phone: $user->phone,
            fullname: $user->fullname,
            active: $user->active,
            sudo: $user->sudo,
            avatar: $avatarUrl
        );
    }
}

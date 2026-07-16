<?php

namespace App\Presentation\Mappers;

use App\Core\Domain\Entities\UserEntity;
use App\Core\UseCases\Auth\ApiLogin\ApiLoginCommand;
use App\Core\UseCases\Auth\Logout\LogoutCommand;
use App\Core\UseCases\Auth\Me\MeCommand;
use App\Presentation\Dto\Auth\ResponseAuthUserDto;
use App\Presentation\Requests\Auth\ApiLoginRequest;
use Illuminate\Http\Request;

class AuthMapper
{
    public static function toApiLoginCommand(ApiLoginRequest $request): ApiLoginCommand
    {
        return new ApiLoginCommand(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }

    public static function toLogoutCommand(Request $request): LogoutCommand
    {
        $token = $request->user()?->currentAccessToken();

        return new LogoutCommand(tokenId: $token?->id ?? '');
    }

    public static function toMeCommand(Request $request): MeCommand
    {
        return new MeCommand(userId: $request->user()->getAuthIdentifier());
    }

    public static function toMeResponse(UserEntity $user): ResponseAuthUserDto
    {
        return new ResponseAuthUserDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            phone: $user->phone,
            fullname: $user->fullname,
            active: $user->active,
            sudo: $user->sudo,
            avatar: $user->avatar
        );
    }
}

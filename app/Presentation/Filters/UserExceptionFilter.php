<?php

namespace App\Presentation\Filters;

use App\Core\Domain\Constants\ErrorCodesConstant;
use App\Core\Domain\Exceptions\User\UserNotFoundByEmailException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
class UserExceptionFilter
{
    public function register(Exceptions $exceptions): void
    {
        $exceptions->render(function (UserNotFoundByEmailException $e, Request $request) {
            return response()->json([
                'error' => 'Пользователь с таким email не найден',
                'code' => ErrorCodesConstant::USER_NOT_FOUND,
            ], 404);
        });
    }
}

<?php

namespace App\Presentation\Controllers\Api\V1;

use App\Core\Ports\Storage\StoragePort;
use App\Core\UseCases\Auth\ApiLogin\ApiLoginUseCase;
use App\Core\UseCases\Auth\Logout\LogoutUseCase;
use App\Core\UseCases\Auth\Me\MeUseCase;
use App\Presentation\Mappers\AuthMapper;
use App\Presentation\Mappers\UserMapper;
use App\Presentation\Requests\Auth\ApiLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

readonly class AuthController
{
    public function __construct(
        private ApiLoginUseCase $apiLoginUseCase,
        private LogoutUseCase   $logoutUseCase,
        private MeUseCase       $meUseCase,
        private StoragePort $storagePort
    ) {}

    #[OA\Post(
        path: '/api/v1/auth/login',
        summary: 'Вход в систему',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/LoginRequest')
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 200, description: 'Успешный вход', content: new OA\JsonContent(ref: '#/components/schemas/LoginResponse')),
            new OA\Response(response: 401, description: 'Неверные учетные данные'),
            new OA\Response(response: 422, description: 'Ошибка валидации', content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')),
        ]
    )]
    public function apiLogin(ApiLoginRequest $request): JsonResponse
    {
        $command = AuthMapper::toApiLoginCommand($request);
        $result = $this->apiLoginUseCase->execute($command);

        $user = UserMapper::toResponse($result->user, $this->storagePort);

        return response()->json([
            'user' => $user,
            'token' => $result->token,
        ]);
    }

    #[OA\Post(
        path: '/api/v1/auth/logout',
        summary: 'Выход из системы (отзыв токена)',
        security: [['sanctum' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 204, description: 'Успешный выход'),
            new OA\Response(response: 401, description: 'Не авторизован', content: new OA\JsonContent(ref: '#/components/schemas/UnauthorizedResponse')),
        ]
    )]
    public function logout(Request $request): JsonResponse
    {
        $command = AuthMapper::toLogoutCommand($request);
        $this->logoutUseCase->execute($command);

        return response()->json(null, 204);
    }

    #[OA\Get(
        path: '/api/v1/auth/me',
        summary: 'Информация о текущем пользователе',
        security: [['sanctum' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 200, description: 'Данные пользователя', content: new OA\JsonContent(ref: '#/components/schemas/UserResource')),
            new OA\Response(response: 401, description: 'Не авторизован', content: new OA\JsonContent(ref: '#/components/schemas/UnauthorizedResponse')),
        ]
    )]
    public function me(Request $request): JsonResponse
    {
        $command = AuthMapper::toMeCommand($request);
        $user = $this->meUseCase->execute($command);

        return response()->json(AuthMapper::toMeResponse($user));
    }
}

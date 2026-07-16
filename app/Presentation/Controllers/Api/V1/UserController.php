<?php

namespace App\Presentation\Controllers\Api\V1;

use App\Core\Ports\Storage\StoragePort;
use App\Core\UseCases\User\CompleteResetPassword\CompleteResetPasswordUserUseCase;
use App\Core\UseCases\User\Create\CreateUserUseCase;
use App\Core\UseCases\User\Delete\DeleteUserUseCase;
use App\Core\UseCases\User\FindAll\FindAllUserUseCase;
use App\Core\UseCases\User\FindById\FindByIdUserUseCase;
use App\Core\UseCases\User\ResetPassword\ResetPasswordUserUseCase;
use App\Core\UseCases\User\Update\UpdateUserUseCase;
use App\Presentation\Mappers\UserMapper;
use App\Presentation\Requests\User\CompleteResetPasswordUserRequest;
use App\Presentation\Requests\User\CreateUserRequest;
use App\Presentation\Requests\User\FindAllUserRequest;
use App\Presentation\Requests\User\ResetPasswordUserRequest;
use App\Presentation\Requests\User\UpdateUserRequest;
use App\Presentation\Utils\PaginationFormatterUtil;
use Illuminate\Http\JsonResponse;

readonly class UserController
{
    public function __construct(
        private StoragePort                      $storagePort,
        private CreateUserUseCase                $createUserUseCase,
        private UpdateUserUseCase                $updateUserUseCase,
        private DeleteUserUseCase                $deleteUserUseCase,
        private FindAllUserUseCase               $findAllUserUseCase,
        private FindByIdUserUseCase              $findByIdUserUseCase,
        private ResetPasswordUserUseCase $resetPasswordUserUseCase,
        private CompleteResetPasswordUserUseCase $completeResetPasswordUserUseCase,
    ) {}

    public function create(CreateUserRequest $request): JsonResponse
    {
        $command = UserMapper::toCreateCommand($request);
        $user = $this->createUserUseCase->execute($command);

        return response()->json(UserMapper::toResponse($user, $this->storagePort), 201);
    }

    public function update(string $id, UpdateUserRequest $request): JsonResponse
    {
        $command = UserMapper::toUpdateCommand($request);
        $user = $this->updateUserUseCase->execute($id, $command);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json(UserMapper::toResponse($user, $this->storagePort));
    }

    public function findAll(FindAllUserRequest $request): JsonResponse
    {
        $command = UserMapper::toFindAllCommand($request);
        $paginatedResult = $this->findAllUserUseCase->execute($command);

        $result = PaginationFormatterUtil::format(
            $paginatedResult,
            fn($aggregate) => UserMapper::toResponseFromAggregate($aggregate, $this->storagePort)
        );
        return response()->json($result);
    }

    public function findMy(): JsonResponse
    {
        $command = UserMapper::toFindByIdCommand(auth()->id());
        $aggregate = $this->findByIdUserUseCase->execute($command);

        if (!$aggregate) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json(UserMapper::toResponseFromAggregate($aggregate, $this->storagePort));
    }

    public function findById(string $id): JsonResponse
    {
        $command = UserMapper::toFindByIdCommand($id);
        $aggregate = $this->findByIdUserUseCase->execute($command);

        if (!$aggregate) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json(UserMapper::toResponseFromAggregate($aggregate, $this->storagePort));
    }

    public function profile(string $id): JsonResponse
    {
        $command = UserMapper::toFindByIdCommand($id);
        $aggregate = $this->findByIdUserUseCase->execute($command);

        if (!$aggregate) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json(UserMapper::toResponseProfile($aggregate->userEntity, $this->storagePort));
    }

    public function delete(string $id): JsonResponse
    {
        $command = UserMapper::toDeleteCommand($id);
        $deleted = $this->deleteUserUseCase->execute($command);

        if (!$deleted) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        return response()->json(null, 204);
    }

    public function resetPassword(ResetPasswordUserRequest $request): JsonResponse
    {
        $command = UserMapper::toResetPasswordCommand($request);
        $this->resetPasswordUserUseCase->execute($command);

        return response()->json(null, 204);
    }

    public function completeResetPassword(CompleteResetPasswordUserRequest $request): JsonResponse
    {
        $command = UserMapper::toCompleteResetPasswordCommand($request);
        $this->completeResetPasswordUserUseCase->execute($command);

        return response()->json(null, 204);
    }
}

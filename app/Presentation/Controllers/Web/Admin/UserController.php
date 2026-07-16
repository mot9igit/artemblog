<?php

namespace App\Presentation\Controllers\Web\Admin;

use App\Core\Ports\Storage\StoragePort;
use App\Core\UseCases\User\FindById\FindByIdUserUseCase;
use App\Presentation\Mappers\UserMapper;
use Illuminate\Http\Request;
use Illuminate\View\View;

readonly class UserController
{
    public function __construct(
        private FindByIdUserUseCase $findByIdUserUseCase,
        private StoragePort $storagePort
    )
    {

    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function update(Request $request): View
    {
        $userId = $request->route()->parameter('userId');
        $command = UserMapper::toFindByIdCommand($userId);
        $userEntity = $this->findByIdUserUseCase->execute($command);
        $user = UserMapper::toResponseFromAggregate($userEntity, $this->storagePort);

        return view('admin.user.update', compact('user'));
    }

    public function findAll(): View
    {
        return view('admin.user.index');
    }
}

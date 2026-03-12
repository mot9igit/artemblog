<?php

namespace App\Services\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface PostServiceInterface
{
    public function create(array $data): Post;
    public function update(Post $post, array $data): Post;
    public function delete(Post $post): void;
    public function getPaginatedApi(int $perPage): array;
    public function getAllApi(): Collection;
    public function getByIdApi(int $id): ?Post;
    public function createApi(array $data): Post;
    public function updateApi(int $id, array $data): ?Post;
    public function deleteApi(int $id): bool;
}

<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{

    /**
     * Берем посты для административной части с фильтрацией
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAdminPaginatedPosts(?string $search, int $perPage): LengthAwarePaginator;

    /**
     * Ищем посты для публичной части
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPublishedPaginated(int $perPage): LengthAwarePaginator;

    /**
     * Ищем опусбликованный пост по slug для публичной части
     *
     * @param string $slug
     * @return Post
     */
    public function findPublishedBySlugOrFail(string $slug): Post;

    public function getPaginatedApi(int $perPage): array;
    public function allApi(): Collection;
    public function findApi(int $postId): ?Post;
    public function createApi(array $data): Post;
    public function updateApi(Post $post, array $data): Post;
    public function deleteApi(Post $post): bool;

}

<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepository\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAdminPaginatedPosts(?string $search, int $perPage): LengthAwarePaginator
    {
        $query = Post::query();
        if($search = trim((string)$search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        return $query->orderByDesc('published_at', 'desc')
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getPublishedPaginated(int $perPage): LengthAwarePaginator
    {
        $posts = Post::where('published', 1)->orderBy('published_at', 'desc')->paginate($perPage);
        return $posts;
    }

    public function findPublishedBySlugOrFail(string $slug): Post
    {
        return Post::query()->where('published', true)->where('slug', $slug)->firstOrFail();
    }

    public function createPost(array $data): Post
    {
        return DB::transaction(function () use ($data) {

        });
    }

    public function updatePost(Post $post, array $data): Post
    {
        return DB::transaction(function () use ($post, $data) {

        });
    }

    public function deletePost(Post $post): void
    {
        DB::transaction(function () use ($post) {

        });
    }
}

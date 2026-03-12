<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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

    public function getPaginatedApi(int $perPage): array
    {
        $posts = Post::query()->latest()->paginate($perPage);

        return [
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total()
            ]
        ];
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

    public function allApi(): Collection
    {
        return Post::latest()->get();
    }

    public function findApi(int $id): ?Post
    {
        return Post::find($id);
    }

    public function createApi(array $data): Post
    {
        return Post::create($data);
    }

    public function updateApi(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    public function deleteApi(Post $post): bool
    {
        return $post->delete();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly PostServiceInterface $postService
    ){}

    public function index(): JsonResponse
    {
//        $posts = Post::query()->latest()->paginate(10);
//
//        return response()->json([
//            'data' => $posts->items(),
//            'meta' => [
//                'current_page' => $posts->currentPage(),
//                'last_page' => $posts->lastPage(),
//                'per_page' => $posts->perPage(),
//                'total' => $posts->total()
//            ]
//        ]);
        return response()->json($this->postService->getPaginatedApi(10));
    }

    public function show($id): JsonResponse
    {
//        $post = Post::query()->find($id);
//
//        if(!$post){
//            return response()->json([
//                'message' => 'Пост не найден'
//            ], 404);
//        }
//
//        return response()->json([
//            'data' => $post
//        ]);
        $post = $this->postService->getByIdApi($id);
        if(!$post){
            return response()->json([
                "message" => "Пост не найден"
            ], 404);
        }

        return response()->json($post);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        return response()->json($this->postService->createApi($data), 201);
    }

    public function update($id, UpdateRequest $request): JsonResponse
    {
        $post = $this->postService->updateApi($id, $request->validated());
        if(!$post){
            return response()->json([
                "message" => "Пост не найден"
            ], 404);
        }

        return response()->json($post);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->postService->deleteApi($id);

        if(!$deleted){
            return response()->json([
                "message" => "Пост не найден"
            ], 404);
        }

        return response()->json([
            "message" => "Пост успешно удален"
        ]);
    }
}

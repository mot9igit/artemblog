<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){}

    public function index(): View{
        $posts = $this->postRepository->getPublishedPaginated(10);
        return view('posts.index', compact('posts'));
    }

    public function show(string $slug): View{
        $post = $this->postRepository->findPublishedBySlugOrFail($slug);
        return view('posts.show', compact('post'));
    }
}

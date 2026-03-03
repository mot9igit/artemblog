<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View{
        $posts = Post::where('published', 1)->orderBy('published_at', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View{
        abort_unless($post->published, 404);
        return view('posts.show', compact('post'));
    }
}

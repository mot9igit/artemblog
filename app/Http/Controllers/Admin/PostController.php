<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Post::query()->where('published', true);
        if($search = trim((string)$request->get('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        $posts = $query->orderByDesc('published_at', 'desc')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            $data["image"] = $request->file('image')->store('posts', 'public');
        }

        $slugBase = Str::slug($data['title']);
        $slug = $slugBase . "-" . rand(1000, 99999);
        $data['slug'] = $slug;
        $data['published_at'] = $request->has('published') ? now() : null;

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        if($request->boolean('remove_image') && $post->image){
            Storage::disk('public')->delete($post->image);
            $data['image'] = null;
        }

        if($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $data["image"] = $request->file('image')->store('posts', 'public');
        }

        $data['published_at'] = $request->has('published') ? now() : null;

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно удален!');
    }
}

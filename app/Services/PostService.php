<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): Post
    {
        $image = $data['image'] ?? null;
        unset($data['image'], $data['remove_image']);

        $slugBase = Str::slug($data['title']);
        $slug = $slugBase . "-" . rand(1000, 99999);
        $data['slug'] = $slug;
        $data['published_at'] = $data['published'] ? now() : null;

        $post = Post::create($data);

        if($image){
            $path = $image->store('posts', 'public');
            $post->image = $path;
            $post->save();
        }

        return $post;
    }

    public function update(Post $post, array $data): Post
    {
        $newImage = $data['image'] ?? null;
        $removeImage = (bool)($data['remove_image']) ?? false;

        unset($data['image'], $data['remove_image']);
        $slugBase = Str::slug($data['title']);
        $slug = $slugBase . "-" . rand(1000, 99999);
        $data['slug'] = $slug;

        $wasPublished = (bool) $post->published;
        $nowPublished = (bool) ($data['published'] ?? $wasPublished);
        $data['published'] = $nowPublished;

        if(!$wasPublished && $nowPublished){
            $data['published_at'] = now();
        }elseif(!$nowPublished && $wasPublished){
            $data['published_at'] = null;
        }

        $post->update($data);

        if($removeImage && $post->image){
            Storage::disk('public')->delete($post->image);
            $post->image = null;
        }

        if($newImage){
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $newImage->store('posts', 'public');
        }

        $post->save();

        return $post;
    }

    public function delete(Post $post): void
    {
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
    }
}

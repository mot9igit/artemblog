<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post');
        return [
            "title" => "required|min:3",
            "slug" => "required|unique:posts,slug,{$postId}",
            "introtext" => "required|min:3",
            "content" => "required|min:3",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "remove_image" => "sometimes|boolean",
            "published" => "nullable|boolean",
            "published_at" => "nullable",
            "user_id" => "nullable|exists:App\Models\User,id",
        ];
    }
}

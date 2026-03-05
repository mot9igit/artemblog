<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $currentPost = $this->route('post');
        return [
            "title" => "required|min:3",
            "slug" => [
                'required',
                Rule::unique('posts', 'slug')
                    ->ignore($currentPost->slug, 'slug')
            ],
            "introtext" => "required|min:3",
            "content" => "required|min:3",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "remove_image" => "sometimes|boolean",
            "published" => "sometimes|boolean",
            "published_at" => "nullable",
            "user_id" => "nullable|exists:App\Models\User,id",
        ];
    }

    // подготовка данных для валидации
    public function prepareForValidation(){
        $this->merge([
            'published' => $this->boolean('published'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }
}

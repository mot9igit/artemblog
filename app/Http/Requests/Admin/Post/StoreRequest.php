<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            "title" => "required|min:3",
            "slug" => "nullable",
            "introtext" => "required|min:10",
            "content" => "required|min:10",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "published" => "nullable|boolean",
            "published_at" => "nullable",
            "user_id" => "nullable|exists:App\Models\User,id",
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Пожалуйста, введите заголовок',
            'introtext.required' => 'Пожалуйста, введите аннотацию',
            'content.required' => 'Пожалуйста, введите текст поста',
            'image.image' => 'Файл должен быть изображением',
        ];
    }
}

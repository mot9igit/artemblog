<?php

namespace App\Presentation\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FindAllUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'name'   => 'nullable|string',
            'email'  => 'nullable|string',
            'active' => 'nullable|boolean',
            'page'   => 'nullable|integer|min:1',
            'limit'  => 'nullable|integer|min:1|max:100',
        ];
    }
}

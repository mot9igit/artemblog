<?php

namespace App\Presentation\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');
        return [
            'name'     => 'sometimes|string|max:255',
            'email'    => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone'    => 'nullable|string|max:50',
            'fullname' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'avatar'   => 'nullable',
            'active'     => 'nullable|boolean',
            'sudo'       => 'nullable|boolean',
            'properties' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Укажите корректный email',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'avatar.image' => 'Файл аватара должен быть изображением',
            'avatar.mimes' => 'Аватар должен быть формата: JPEG, PNG, JPG, GIF, SVG',
            'avatar.max' => 'Максимальный размер аватара 2МБ',
        ];
    }
}

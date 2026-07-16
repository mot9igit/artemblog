<?php

namespace App\Presentation\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|max:255',
            'phone'    => 'nullable|string|max:50',
            'fullname' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active'     => 'nullable|boolean',
            'sudo'       => 'nullable|boolean',
            'properties' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, укажите имя пользователя',
            'email.required' => 'Пожалуйста, укажите email',
            'email.email' => 'Укажите корректный email',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Пожалуйста, укажите пароль',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'avatar.image' => 'Файл аватара должен быть изображением',
            'avatar.mimes' => 'Аватар должен быть формата: JPEG, PNG, JPG, GIF, SVG',
            'avatar.max' => 'Максимальный размер аватара 2МБ',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Ошибка валидации данных'
            ], 422)
        );
    }
}

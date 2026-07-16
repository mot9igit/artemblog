<?php

namespace App\Presentation\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompleteResetPasswordUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'    => 'required|uuid|exists:users,reset_password_token',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Укажите токен',
            'token.exists' => 'Токен не найден',
            'password.required' => 'Пожалуйста, укажите пароль',
            'password.min' => 'Пароль должен быть не менее 8 символов',
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

<?php

namespace App\Presentation\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email|max:255|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Укажите корректный email',
            'email.exists' => 'Пользователя с таким email не существует'
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

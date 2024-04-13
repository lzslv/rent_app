<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string',
            'email' => 'string',
            'old_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'role' => 'int',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'old_password.min' => 'Длина текущего пароля должна быть не менее 8 символов',
            'password.min' => 'Длина нового пароля должна быть не менее 8 символов',
            'password_confirmation.min' => 'Длина подтверждения пароля должна быть не менее 8 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            User::EMAIL_INPUT_NAME => ['required', 'email'],
            User::PASSWORD_INPUT_NAME => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            User::EMAIL_INPUT_NAME . '.required' => 'Please enter your email.',
            User::EMAIL_INPUT_NAME . '.email' => 'Enter a valid email address.',
            User::PASSWORD_INPUT_NAME . '.required' => 'Please enter your password.'
        ];
    }
}

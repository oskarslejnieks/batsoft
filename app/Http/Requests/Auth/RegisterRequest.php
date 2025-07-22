<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            User::NAME_INPUT_NAME => ['required', 'string', 'max:255'],
            User::EMAIL_INPUT_NAME  => ['required', 'email', 'max:255', 'unique:users,email'],
            User::PASSWORD_INPUT_NAME => ['required', 'string', 'min:8'],
            User::PASSWORD_REPEAT_INPUT_NAME  => ['required', 'same:' . User::PASSWORD_INPUT_NAME]
        ];
    }

    public function messages(): array
    {
        return [
            User::NAME_INPUT_NAME . '.required' => 'Please enter your name.',
            User::EMAIL_INPUT_NAME . '.unique' => 'This email is already taken.',
            User::PASSWORD_INPUT_NAME . '.min' => 'Password must be at least :min characters.',
            User::PASSWORD_REPEAT_INPUT_NAME . '.same' => 'Passwords need to be the same.'
        ];
    }
}

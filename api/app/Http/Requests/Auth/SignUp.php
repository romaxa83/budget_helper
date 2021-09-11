<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SignUp extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email',
                Rule::unique('users', 'email')
            ],
            'password' => ['required', 'string', Password::min(5)],
            'phone' => ['nullable', 'string'],
        ];
    }
}

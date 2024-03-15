<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:9', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', 'max:24'],

        ];
    }
}

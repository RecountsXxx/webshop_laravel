<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:3','max:15'],
            'email' => ['required', 'string', 'email','unique:users,email','min:8','max:36'],
            'password' => ['required', 'string','min:3','max:25'],
        ];
    }
}

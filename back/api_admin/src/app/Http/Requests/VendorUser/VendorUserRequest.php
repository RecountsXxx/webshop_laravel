<?php

namespace App\Http\Requests\VendorUser;

use Illuminate\Foundation\Http\FormRequest;
class VendorUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:9', 'unique:vendor_users,name'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:vendor_users,email'],
            'password' => ['required', 'string', 'min:3', 'max:24'],

        ];
    }
}

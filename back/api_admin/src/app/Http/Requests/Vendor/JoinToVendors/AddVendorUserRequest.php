<?php

namespace App\Http\Requests\Vendor\JoinToVendors;

use Illuminate\Foundation\Http\FormRequest;

class AddVendorUserRequest extends FormRequest
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
            'id' =>['required','integer'],
            'name' => ['required', 'string', 'min:3', 'max:9', 'unique:vendor_users,name'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:vendor_users,email'],
        ];
    }
}

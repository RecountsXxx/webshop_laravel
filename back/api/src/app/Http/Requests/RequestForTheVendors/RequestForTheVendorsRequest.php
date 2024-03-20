<?php

namespace App\Http\Requests\RequestForTheVendors;

use Illuminate\Foundation\Http\FormRequest;

class RequestForTheVendorsRequest extends FormRequest
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
            'shop_name'=>['required','string','min:3','max:9','unique:vendors,vendor_name'],
            'description'=>['required','string','min:50','max:1000'],
            'email'=>['required','email','min:3','max:256','unique:request_for_the_vendors,email','unique:vendor_users,email'],
        ];
    }
}

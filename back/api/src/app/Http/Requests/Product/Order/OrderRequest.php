<?php

namespace App\Http\Requests\Product\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'full_name'=>['string','required','min:3','max:256'],
            'email'=>['email','required','min:3','max:256'],
            'address'=>['string','required','min:3','max:256'],
            'product_id'=>['integer','required','exists:products,id'],
            'vendor_id'=>['integer','required','exists:vendors,id'],
            'type_payment'=>['string','required','min:3','max:21']
        ];
    }
}

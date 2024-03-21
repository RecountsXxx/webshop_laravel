<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['string', 'required', 'min:3', 'max:56'],
            'description' => ['string', 'required', 'min:50', 'max:1000'],
            'count' => ['integer','required'],
            'new_price' => ['numeric', 'between:1,1000000000'],
            'price' => ['numeric', 'required', 'between:1,1000000000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
        ];
    }
}

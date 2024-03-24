<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'title'=>['string','min:3'],
            'vendor'=>['string','exists:vendors,vendor_name'],
            'category'=>['string','exists:categories,category_name'],
            'brand'=>['string','exists:brands,brand_name'],
            'minPrice'=>['double'],
            'maxPrice'=>['double'],
        ];
    }
}

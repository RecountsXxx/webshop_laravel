<?php

namespace App\Http\Requests\Product\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'text'=>['string','required','min:3','max:1000'],
            'rating'=>['integer','min:0','max:5','required'],
            'product_id'=>['integer','required','exists:products,id'],
            'author_id'=>['integer','required','exists:users,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => 'required|string|min:1|max:100',
            'text' => 'required|string|min:1',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }
}

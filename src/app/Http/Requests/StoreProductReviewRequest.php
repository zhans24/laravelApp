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

    public function messages(): array
    {
        return [
            'user_name.required' => 'User name is required.',
            'user_name.min' => 'User name must be at least 1 character.',
            'user_name.max' => 'User name must not exceed 100 characters.',
            'text.required' => 'Review text is required.',
            'text.min' => 'Review text must be at least 1 character.',
            'rating.required' => 'Rating is required.',
            'rating.integer' => 'Rating must be an integer.',
            'rating.min' => 'Rating must be at least 1.',
            'rating.max' => 'Rating must not exceed 5.',
        ];
    }
}

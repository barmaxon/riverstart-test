<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products',
            'price' => 'required|integer|min:100|max:50000',
            'published' => 'boolean',
            'categories' => 'required|array|min:2|max:10',
            'categories.*' => 'exists:categories,id',
        ];
    }
}

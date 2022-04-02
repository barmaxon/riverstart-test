<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'string',
            'categoryName' => 'string',
            'categoryId' => 'integer|prohibits:categoryName',
            'priceFrom' => 'integer|min:100|max:50000',
            'priceTo' => 'integer|min:100|max:50000' . ($this->exists('priceFrom') ? '|gt:priceFrom' : ''),
            'published' => 'boolean',
            'withoutTrashed' => 'boolean',
        ];
    }
}

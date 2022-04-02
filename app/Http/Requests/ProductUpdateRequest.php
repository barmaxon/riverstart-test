<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Product product
 */
class ProductUpdateRequest extends FormRequest
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
            'name' => [Rule::unique('products', 'name')->ignore($this->product->id)],
            'price' => 'integer|min:100|max:50000',
            'published' => 'boolean',
            'categories' => 'array|min:2|max:10',
            'categories.*' => 'exists:categories,id',
        ];
    }
}

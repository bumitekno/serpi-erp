<?php

namespace Modules\ProductPos\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'code_product' => 'required|string|max:250|unique:product_pos,code_product',
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'category' => 'required|string|max:250',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}

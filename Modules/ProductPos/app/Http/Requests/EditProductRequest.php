<?php

namespace Modules\ProductPos\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'category' => 'required|string|max:250',
            'image_product' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
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

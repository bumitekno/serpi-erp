<?php

namespace Modules\CategoryProduct\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryProduct extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:250|unique:category_product,name,' . $this->segment(2),
            'image_category' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
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

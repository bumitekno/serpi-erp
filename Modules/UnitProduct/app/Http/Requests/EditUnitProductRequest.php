<?php

namespace Modules\UnitProduct\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUnitProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:250|unique:unit_product,name,' . $this->segment(2) . '',
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

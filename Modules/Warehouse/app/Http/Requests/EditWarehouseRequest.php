<?php

namespace Modules\Warehouse\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWarehouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:250|unique:warehouse,name,' . $this->segment(2),
            'code' => 'required|string|max:250|unique:warehouse,code,' . $this->segment(2)
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

<?php

namespace Modules\Users\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required',
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
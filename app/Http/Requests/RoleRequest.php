<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->id)
        {
            $id = decrypt($this->id);
            $rule = [
                'name' => "required|min:3|regex:/^[a-zA-Z0-9 ]+$/u|unique:roles,name,$id"
            ];
        }
        else
        {
            $rule = [
                'name' => 'required|min:3|unique:roles|regex:/^[a-zA-Z0-9 ]+$/u'
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter role name'
        ];
    }
}

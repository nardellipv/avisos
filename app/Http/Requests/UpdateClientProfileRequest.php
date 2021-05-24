<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientProfileRequest extends FormRequest
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
            'name' => 'required | min:3',
            'lastname' => 'required | min:3',
            'email' => 'required | email | unique:users,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El Nombre es requerido',
            'name.min' => 'El Nombre es muy corto',
            'lastname.required' => 'El Apellido es requerido',
            'lastname.min' => 'El Apellido es muy corto',
            'email.required' => 'El mail es requerido',
            'email.email' => 'El mail debe tener formato correcto',
        ];
    }
}

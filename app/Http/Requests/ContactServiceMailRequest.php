<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactServiceMailRequest extends FormRequest
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
            'email' => 'required',
            'message-client' => 'required | min:10 | max:200',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tu Nombre es requerido',
            'name.min' => 'Tu Nombre debe ser real',
            'email.required' => 'Tu Email es requerido',
            'message-client.required' => 'El Mensaje es requerido',
            'message-client.min' => 'La Mesaje es muy corto',
            'message-client.max' => 'La Mesaje es muy largo, máximo 200',
        ];
    }
}

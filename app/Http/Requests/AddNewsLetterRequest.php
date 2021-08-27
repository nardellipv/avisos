<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewsLetterRequest extends FormRequest
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
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tu Nombre es requerido',
            'name.min' => 'Tu Nombre debe ser real',
            'email.required' => 'Tu Email es requerido',            
        ];
    }
}

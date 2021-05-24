<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponseSerivceMailResquest extends FormRequest
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
            'messageResponse' => 'required | min:10 | max:200',
        ];
    }
    public function messages()
    {
        return [
            'messageResponse.required' => 'El Mensaje es requerido',
            'messageResponse.min' => 'La Mesaje es muy corto',
            'messageResponse.max' => 'La Mesaje es muy largo, máximo 200',
        ];
    }
}

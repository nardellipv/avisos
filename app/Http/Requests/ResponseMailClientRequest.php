<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResponseMailClientRequest extends FormRequest
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
            'response' => 'required | min:10 | max:250',
        ];
    }
    public function messages()
    {
        return [
            'response.required' => 'La respuesta es requerida.',
            'response.min' => 'Tiene que responder algo real.',
            'response.max' => 'Tu respuesta no debe superar los 250 caracteres.',
        ];
    }
}

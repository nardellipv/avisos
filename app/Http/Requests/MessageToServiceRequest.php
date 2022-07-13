<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageToServiceRequest extends FormRequest
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
            'serviceUser' => 'required',
            'email' => 'required',
            'messageService' => 'required | min:10 | max:200',
            'g-recaptcha-response' => 'recaptcha',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tu Nombre es requerido',
            'name.min' => 'Tu Nombre debe ser real',
            'serviceUser.required' => 'Hubo un error desconocido, por favor recargue la página e intente nuevamente enviar su mensaje',
            'email.required' => 'Tu Email es requerido',            
            'messageService.required' => 'El Mensaje es requerido',
            'messageService.min' => 'La Mesaje es muy corto',
            'messageService.max' => 'La Mesaje es muy largo, máximo 200',
            'g-recaptcha-response.recaptcha' => 'El captcha es necesario.'
        ];
    }
}

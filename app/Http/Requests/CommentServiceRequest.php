<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentServiceRequest extends FormRequest
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
            'comment' => 'required | min:10 | max:200',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tu Nombre es requerido',
            'name.min' => 'Tu Nombre debe ser real',
            'email.required' => 'Tu Email es requerido',            
            'comment.required' => 'El Mensaje es requerido',
            'comment.min' => 'La Mesaje es muy corto',
            'comment.max' => 'La Mesaje es muy largo, máximo 200',
        ];
    }
}

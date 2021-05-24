<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'title' => 'required | min:5 | max:60',
            'description' => 'required | min:10',
            'category_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'El Título es requerido',
            'title.min' => 'El Título es muy corto',
            'title.max' => 'El Título es muy largo',
            'description.required' => 'La Descripción es requerido',
            'description.min' => 'La Descripción es muy corto',
            'category_id.required' => 'La Categoría es requerida',
        ];
    }
}

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
            'name'      => 'required|min:3',
            'lastname'  => 'required|min:3',
            'region_id' => 'required|exists:regions,id',
            'photo'     => 'nullable|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required'       => 'El Nombre es requerido',
            'name.min'            => 'El Nombre debe tener al menos 3 caracteres',
            'lastname.required'   => 'El Apellido es requerido',
            'lastname.min'        => 'El Apellido debe tener al menos 3 caracteres',
            'region_id.required'  => 'La Localidad es requerida',
            'region_id.exists'    => 'La Localidad seleccionada no es válida',
            'photo.image'         => 'El archivo debe ser una imagen',
            'photo.max'           => 'La imagen no puede superar los 2 MB',
        ];
    }
}

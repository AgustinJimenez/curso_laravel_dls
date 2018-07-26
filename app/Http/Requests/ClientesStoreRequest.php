<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesStoreRequest extends FormRequest
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
        return 
        [
            'razon_social' => 'required|unique:' . (new \Cliente)->getTable() . '|max:60',
            'ruc' => 'required|unique:' . (new \Cliente)->getTable() . '|max:15'
        ];
    }

/**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
public function messages()
{
    return 
    [
        'razon_social.required' => 'La razon social es requerida.',
        'razon_social.unique'  => 'La razon social ya existe en el sistema',
        'razon_social.max' => 'La razon social solo puede contener hasta 60 caracteres',
        'ruc.required' => 'El RUC es requerida.',
        'ruc.unique'  => 'El RUC ya existe en el sistema',
        'ruc.max' => 'El RUCsolo puede contener hasta 60 caracteres'
    ];
}

}

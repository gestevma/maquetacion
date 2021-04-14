<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'region' => 'required',
            'town' => 'required',
            'adress' => 'required',
            'postcode' => 'required',
            'telephone' => 'required | regex:/^[+0-9]+$/i',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe añadir un nombre',
            'email.required' => 'Debe añadir un email',
            'email.email' => 'El formato de correo electrónico no es válido',
            'country.required' => 'Debe añadir un País',
            'region.required' => 'Debe añadir una provincia',
            'town.required' => 'Debe añadir una población',
            'adress.required' => 'Debe añadir una dirección',
            'postcode.required' => 'Debe añadir un código postal',
            'telephone.required' => 'Debe añadir un teléfono',
            'telephone.regex' => 'el formato del número de télefono no es válido'
        ];
    }
}

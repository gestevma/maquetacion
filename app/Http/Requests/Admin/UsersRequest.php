<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'password' => 'required|alpha-num',
            'confirm_password' => 'required | same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El usuario es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo debe tener un formato valido',
            'password.required' => 'Debe añadir una contraseña',
            'password.alpha-num' => 'La contraseña no debe puede contener caracteres especiales',
            'confirm_password.required' => 'Debe confirmar la contraseña',
            'confirm_password.same' => 'Las contraseñas deben ser iguales',
        ];
    }
}
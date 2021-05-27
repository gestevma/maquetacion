<?php

/*
|--------------------------------------------------------------------------
| Validaciones del formulario de la sección FAQ's
|--------------------------------------------------------------------------
|
| **authorize: determina si el usuario debe estar autorizado para enviar el formulario. 
|
| **rules: recoge las normas que se deben cumplir para validar el formulario. Los errores son 
|   devueltos en forma de objeto JSON en un error 422.
| 
| **messages: mensajes personalizados de error.
|    
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'original_price' => 'required',
            'taxes' => 'required',
            'final_price' => 'required',
            'stock' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'original_price.required' => 'El precio es obligatorio',
            'taxes.required' => 'Debe añadir los impuestos',
            'final_price.required' => 'No se ha registrado el precio final',
            'stock.required' =>'El stock no se ha añadido correctamente',
            'type.required' => 'El tipo de libro es obligatorio',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrendaFormRequest extends FormRequest
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
            'idCategoria'=>'required',
            'nombre' =>'required|max:45',
            'talle' =>'required|max:45',
            'color' => 'max:45',
            'estado'=> 'max:15',
            

        ];
    }
}

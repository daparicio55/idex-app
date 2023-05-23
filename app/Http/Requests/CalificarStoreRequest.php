<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificarStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         if (calificacion_cerrado($this->route('id')) == true){
            return false;
         }else{
            return true;
         }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

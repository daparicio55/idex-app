<?php

namespace App\Http\Requests;

use App\Models\Uasignada;
use Illuminate\Foundation\Http\FormRequest;
use Maatwebsite\Excel\Concerns\ToArray;

class CapacidadeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $uasignada = Uasignada::findOrFail($this->request->get('uasignada_id'));
        if($uasignada->periodo->plan_cerrado == true){
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
        $uasignada = Uasignada::findOrFail($this->request->get('uasignada_id'));
        return [
            //
            'fecha'=>'before_or_equal:'.$uasignada->periodo->ffin,
        ];
    }
}

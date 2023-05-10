<?php

namespace App\Http\Requests;

use App\Models\Uasignada;
use Carbon\Carbon;
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
            if(isset($uasignada->apertura->fecha)){
                $fecha_hora = Carbon::create(date('Y',strtotime($uasignada->apertura->fecha)),date('m',strtotime($uasignada->apertura->fecha)),date('d',strtotime($uasignada->apertura->fecha)),date('h',strtotime($uasignada->apertura->fecha)),date('i',strtotime($uasignada->apertura->fecha)),date('s',strtotime($uasignada->apertura->fecha)));
                $diferencia = Carbon::now()->diffInHours($fecha_hora);
                if($diferencia<25){
                    return true;
                }
            }
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

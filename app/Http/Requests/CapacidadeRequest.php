<?php

namespace App\Http\Requests;

use App\Models\Capacidade;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CapacidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $capacidade = Capacidade::findOrFail($this->route('capacidade'));
        if($capacidade->uasignada->periodo->plan_cerrado == true){
            //vamos a verificar si temos abierto el plan.
            if(isset($capacidade->uasignada->apertura->fecha)){
                $fecha_hora = Carbon::create(date('Y',strtotime($capacidade->uasignada->apertura->fecha)),date('m',strtotime($capacidade->uasignada->apertura->fecha)),date('d',strtotime($capacidade->uasignada->apertura->fecha)),date('h',strtotime($capacidade->uasignada->apertura->fecha)),date('i',strtotime($capacidade->uasignada->apertura->fecha)),date('s',strtotime($capacidade->uasignada->apertura->fecha)));
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
        //dd($this->request);
        $capacidade = Capacidade::findOrFail($this->route('capacidade'));
        return [
            //
            'fecha'=>'before_or_equal:'.$capacidade->uasignada->periodo->ffin,
        ];
    }
}

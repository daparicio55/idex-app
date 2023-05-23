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
        return !capacidad_cerrado($capacidade->uasignada->id);
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

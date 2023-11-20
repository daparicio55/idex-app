<?php

namespace App\Livewire\Forms\Indicadores;

use App\Models\Indicator;
use Livewire\Attributes\Rule;
use Livewire\Form;

class IndicatorCreateForm extends Form
{
    public $nombre;
    public $descripcion;
    public $capabilitie_id;
    public $modal = false;
    public function create($id){
        $this->capabilitie_id = $id;
        $this->modal = true;
    }
    public function store(){
        $indicator = new Indicator();
        $indicator->nombre = $this->nombre;
        $indicator->descripcion = $this->descripcion;
        $indicator->capabilitie_id = $this->capabilitie_id;
        $indicator->save();
        $this->modal = false;
    }
}

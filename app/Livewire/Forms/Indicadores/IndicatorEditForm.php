<?php

namespace App\Livewire\Forms\Indicadores;

use App\Models\Indicator;
use Livewire\Attributes\Rule;
use Livewire\Form;

class IndicatorEditForm extends Form
{
    //
    public $id;
    public $nombre;
    public $descripcion;
    public $modal = false;
    public function edit($id){
        $this->id = $id;
        $indicator = Indicator::findOrFail($id);
        $this->nombre = $indicator->nombre;
        $this->descripcion = $indicator->descripcion;
        $this->modal = true;
    }
    public function update(){
        $indicator = Indicator::findOrFail($this->id);
        $indicator->nombre = $this->nombre;
        $indicator->descripcion = $this->descripcion;
        $indicator->update();
        $this->modal = false;
    }
}

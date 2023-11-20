<?php

namespace App\Livewire\Forms\Indicadores;

use App\Models\Indicator;
use Livewire\Attributes\Rule;
use Livewire\Form;

class IndicatorDeleteForm extends Form
{
    public $id;
    public $nombre;
    public $descripcion;    
    public $modal = false;
    public function delete($id){
        $this->id = $id;
        $this->modal = true;
    }
    public function destroy(){
        $indicator = Indicator::findOrFail($this->id);
        $indicator->delete();
        $this->modal = false;
    }
}

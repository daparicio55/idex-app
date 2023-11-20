<?php

namespace App\Livewire\Forms\Capacidades;

use App\Models\Capabilitie;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CapacidadeEditForm extends Form
{
    //
    public $id;
    public $nombre;
    public $descripcion;
    public $modal = false;
    public function edit($id){
        $this->id = $id;
        $capacidade = Capabilitie::findOrFail($id);
        $this->nombre = $capacidade->nombre;
        $this->descripcion = $capacidade->descripcion;
        $this->modal = true;
    }
    public function update(){
        $capacidade = Capabilitie::findOrFail($this->id);
        $capacidade->nombre = $this->nombre;
        $capacidade->descripcion = $this->descripcion;
        $capacidade->update();
        $this->modal = false;
    }
}

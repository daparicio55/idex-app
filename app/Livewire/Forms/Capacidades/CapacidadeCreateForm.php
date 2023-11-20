<?php

namespace App\Livewire\Forms\Capacidades;

use App\Models\Capabilitie;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CapacidadeCreateForm extends Form
{
    //
    public $udidactica_id;
    public $nombre;
    public $descripcion;
    public $modal = false;
    public function create($id){
        $this->udidactica_id = $id;
        $this->modal = true;
    }
    public function store(){
        $capacidade = new Capabilitie();
        $capacidade->nombre = $this->nombre;
        $capacidade->descripcion = $this->descripcion;
        $capacidade->udidactica_id = $this->udidactica_id;
        $capacidade->save();
        $this->modal = false;
    }
}

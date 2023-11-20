<?php

namespace App\Livewire\Forms;

use App\Models\Udidactica;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UdidacticaEditForm extends Form
{
    //
    public $id;
    public $nombre;
    public $creditos;
    public $horas;
    public $ciclo="";
    public $moodle;
    public $tipo="";
    public $orden;
    public $modal = false;
    public function edit($id){
        $this->id = $id;
        $unidad = Udidactica::findOrFail($id);
        $this->nombre = $unidad->nombre;
        $this->creditos = $unidad->creditos;
        $this->horas = $unidad->horas;
        $this->ciclo = $unidad->ciclo;
        $this->moodle = $unidad->moodle;
        $this->tipo = $unidad->tipo;
        $this->orden = $unidad->orden;
        $this->modal = true;
    }
    public function update(){
        $unidad = Udidactica::findOrFail($this->id);
        $unidad->nombre=$this->nombre;
        $unidad->creditos=$this->creditos;
        $unidad->horas=$this->horas;
        $unidad->ciclo=$this->ciclo;
        $unidad->moodle=$this->moodle;
        $unidad->tipo=$this->tipo;
        $unidad->orden=$this->orden;
        $unidad->update();
        $this->modal = false;
    }
}

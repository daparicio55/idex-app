<?php

namespace App\Livewire\Forms;

use App\Models\Udidactica;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UdidacticaCreateForm extends Form
{ 
    public $nombre;
    public $creditos;
    public $horas;
    public $ciclo="";
    public $moodle;
    public $tipo="";
    public $orden;
    public $mformativo_id;
    public $modal = false;
    public function create(){
        $this->modal = true;
    }
    public function store($mformativo_id){
        $this->mformativo_id = $mformativo_id;
        Udidactica::create(
            $this->only('nombre','creditos','horas','ciclo','moodle','mformativo_id','tipo','orden')
        );
        $this->modal = false;
    }
}

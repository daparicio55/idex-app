<?php

namespace App\Livewire\Forms\Capacidades;

use App\Models\Capabilitie;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CapacidadeDeleteForm extends Form
{
    //
    public $id;
    public $modal = false;
    public function delete($id){
        $this->id = $id;
        $this->modal = true;
    }
    public function destroy(){
        $capacidade = Capabilitie::findOrFail($this->id);
        $capacidade->delete();
        $this->modal = false;
    }
}

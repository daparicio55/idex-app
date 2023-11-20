<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public $count = 0;
    public function incrementar($cant){
        $this->count+=$cant;
    }
    public function decrementar($cant){
        $this->count-=$cant;
    }
    public function render()
    {
        return view('livewire.contador');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $paises = [
        'Peru',
        'Colombia',
        'Venezuela'
    ];
    public $pais;
    public function guardar(){
        array_push($this->paises,$this->pais);
        $this->reset('pais');
    }
    public function delete($key){
        unset($this->paises[$key]);
    }
    public function render()
    {
        return view('livewire.paises');
    }
}

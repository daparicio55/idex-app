<?php

namespace App\Livewire\Ventas;

use App\Models\Servicio;
use Livewire\Component;

class AddServices extends Component
{
    public $idServicio='';
    public $a_ids=[];
    public $listservices;
    public $items=[];
    public $services;
    public $precio;
    public $cantidad;
    public $id;
    public function addservicio(){
        $servicio = Servicio::find($this->idServicio);
        $item = [
            'idServicio'=>$servicio->idServicio,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio,
            'descripcion'=>$servicio->nombre,
        ];
        array_push($this->items,$item);
        //agregar esto a un array
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'idServicio') {
            //llenar los campos precio y cantidad.
            $servicio = Servicio::find($this->idServicio);
            $this->precio = $servicio->precio;
            $this->cantidad = 1;
        }
    }
    public function mount(){
        $this->services = [];
    }
    public function render()
    {
        $this->services = Servicio::where('estado','=',1)
        ->orderBy('nombre','desc')
        ->get();
        return view('livewire..ventas.add-services');
    }
    public function delete($key){
        unset($this->items[$key]);
    }
    
}

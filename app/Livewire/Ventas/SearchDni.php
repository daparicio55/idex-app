<?php

namespace App\Livewire\Ventas;

use App\Models\Cliente;
use App\Models\Servicio;
use Livewire\Component;

class SearchDni extends Component
{
    public $txtbuscar;
    public $btndni;
    //cliente
        public $idCliente;
        public $nombre;
        public $apellido;
        public $direccion;
        public $telefono;
        public $telefono2;
        public $email;
    //fin cliente
    public function buscardni(){
        $cliente = Cliente::where('dniRuc','=',$this->txtbuscar)->first();
        if(isset($cliente->idCliente)){
            $this->idCliente = $cliente->idCliente;
            $this->nombre = $cliente->nombre;
            $this->apellido = $cliente->apellido;
            $this->direccion = $cliente->direccion;
            $this->telefono = $cliente->telefono;
            $this->telefono2 = $cliente->telefono2;
            $this->email = $cliente->email;
        }else{
            $cliente = getdni($this->txtbuscar);
            $this->idCliente = $cliente->idCliente;
            $this->nombre = $cliente->nombre;
            $this->apellido = $cliente->apellido;
            $this->direccion = $cliente->direccion;
            $this->telefono = $cliente->telefono;
            $this->telefono2 = $cliente->telefono2;
            $this->email = $cliente->email;
        }
    }
    public function render()
    {
        return view('livewire..ventas.search-dni');
    }
}

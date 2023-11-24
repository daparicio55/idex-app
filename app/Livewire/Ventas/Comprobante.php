<?php

namespace App\Livewire\Ventas;

use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;

class Comprobante extends Component
{
    public $numero;
    public $fecha;
    public $observacion="-";
    public $comprobante;
    public $tpago;
    public function mount(){
        //ultima venta
        $venta = Venta::orderBy('numero','desc')->first();
        $this->numero = $venta->numero + 1;
        $this->fecha = date('Y-m-d',strtotime(Carbon::now()));
    }
    public function render()
    {
        return view('livewire..ventas.comprobante');
    }
}

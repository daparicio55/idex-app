<?php

namespace App\Exports;

use App\Models\Deuda;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteDeudaAdministradorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
 
    public function view(): View{
        $deudas = Deuda::orderBy('numero','desc')
        ->where('estado','=','deuda')
        ->get();
        return view('administrador.reportedeudas',compact('deudas'));
    }


}

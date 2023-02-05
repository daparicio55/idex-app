<?php

namespace App\Exports;

use App\Models\CepreEstudiante;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CepreEstudianteExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $idCepre;
    public function __construct($idCepre)
    {
        $this->idCepre = $idCepre;
    }
    public function view(): View
    {
        //
        $estudiantes = CepreEstudiante::where('idCepre','=',$this->idCepre)
        ->where('sumatorio','=','SI')
        ->get();
        return view('exports.cepreEstudiantes',compact('estudiantes'));
    }

}

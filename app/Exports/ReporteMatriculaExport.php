<?php

namespace App\Exports;

use App\Models\Ematricula;
use App\Models\Pmatricula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteMatriculaExport implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $periodo = Pmatricula::findOrFail($this->id);
        $matriculas = Ematricula::where('pmatricula_id','=',$this->id)
        ->get();
        return view('sacademica.estadisticas.show',compact('matriculas','periodo'));
    }
}

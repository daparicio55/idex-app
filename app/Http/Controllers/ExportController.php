<?php

namespace App\Http\Controllers;

use App\Exports\Nomina1Export;
use App\Exports\Nomina2Export;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Models\Carrera;
use App\Models\Pmatricula;
use App\Models\Udidactica;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nomina1(Request $request){
        $periodo = Pmatricula::findOrFail($request->periodo_id);
        $carrera = Carrera::findOrFail($request->carrera_id);
        $vista = new Nomina1Export($request->carrera_id,$request->periodo_id,$request->ciclo);
        return Excel::download($vista,$periodo->nombre.'-'.$carrera->nombreCarrera.'-'.$request->ciclo.'.xlsx');
    }
    public function nomina2(Request $request){
        $carrera = Carrera::findOrFail($request->carrera);
        $periodo = Pmatricula::findOrFail($request->periodo_id);
        $unidad = Udidactica::findOrFail($request->udidactica_id);
        $vista = new Nomina2Export($request->periodo_id,$request->udidactica_id,$request->carrera);
        return Excel::download($vista,$periodo->nombre.'-'.$unidad->nombre.'.xlsx');
    }
}

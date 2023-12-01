<?php

namespace App\Http\Controllers\Imports;

use App\Exports\PlantillaCalificacionExport;
use App\Http\Controllers\Controller;
use App\Imports\NotasExcel;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IndicadoresController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        /* $request->validate(
            'file','required',
        ); */
        $array=[];
        $ar = (Excel::toArray(new  NotasExcel, request()->file('file')));
        //return $ar[0][1];
        foreach ($ar[0] as $a) {
            # code...
            $b=[
                'dni'=>$a[1],
                'nota'=>$a[3],
            ];
            array_push($array,$b);
        }
        return json_encode($array);
    }
    public function plantilla(Request $request){

        $vista = new PlantillaCalificacionExport($request);
        return Excel::download($vista,'Archivo.xlsx');
        /* $vista = new Nomina2Export($request->periodo_id,$request->udidactica_id,$request->carrera,$ciclo); */
        /* return Excel::download($vista,$periodo->nombre.'-'.$unidad->nombre.'.xlsx'); */
        
    }
}

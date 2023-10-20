<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDeudaAdministradorExport;
use App\Models\Admisione;
use App\Models\Deuda;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Mformativo;
use App\Models\Practica;
use App\Models\Udidactica;
use Maatwebsite\Excel\Facades\Excel;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:administrador.index')->only('index');
        $this->middleware('can:administrador.reporteingresantes')->only('reporteingresantes');
        $this->middleware('can:administrador.checknotas')->only('checknotas');
        $this->middleware('can:administrador.checkeformativas')->only('checkeformativas');
    }
    public function index(){
        $admisiones = Admisione::orderBy('periodo','desc')->take(10)->get();
        return view('administrador.index',compact('admisiones'));
    }
    public function reportedeudas(){
        $reporte = new ReporteDeudaAdministradorExport;
        return Excel::download($reporte,"Reportedeudas.xlsx"); 
    }
    public function reporteingresantes($id){
        try {
            //code...
            $admisione = Admisione::findOrFail($id);
            $estudiantes = Estudiante::whereHas('postulante',function($query) use($admisione){
                $query->where('admisione_id','=',$admisione->id);
            })->get();
        } catch (\Throwable $th) {
            //throw $th;
            return($th->getMessage());
        }
        return view('administrador.reporteingresantes',compact('estudiantes','admisione'));
    }
    public function checkeformativas(){
        set_time_limit(0);
        $array=[];
        foreach (Estudiante::get() as $estudiante) {
            # code...
            $modulos = Mformativo::where('carrera_id','=',$estudiante->postulante->carrera->idCarrera)->get();
            /* $modules = []; */
            $completo = "SI";
            foreach ($modulos as $modulo) {
                # code...
                $practica = Practica::where('estudiante_id','=',$estudiante->id)->where('mformativo_id','=',$modulo->id)->count();
                /* array_push($modules,[
                    'nombre'=>$modulo->nombre,
                    'practica'=>$practica,
                ]); */
                if ($practica == 0){
                    $completo = "NO";
                }
            }
            array_push($array,[
                'estudiante_id'=>$estudiante->id,
                'estudiante'=>$estudiante->postulante->cliente->dniRuc,
                /* 'modulos'=>$modules, */
                'completo' => $completo,
            ]);
        }
        return $array;
    }
    public function checknotas(){
        set_time_limit(0);
        $array=[];
        /* $estudiantes = Estudiante::get(); */
        foreach (Estudiante::get() as $estudiante) {
            # code...
            $unidades = Udidactica::whereHas('modulo',function($query) use($estudiante){
                $query->where('carrera_id','=',$estudiante->postulante->carrera->idCarrera);
            })->get();
            $uni = [];
            foreach ($unidades as $unidade) {
                # code...
                $notas = [];
                $mdetalles = EmatriculaDetalle::whereHas('matricula',function($query) use($unidade,$estudiante){
                    $query->where('udidactica_id','=',$unidade->id)->where('estudiante_id','=',$estudiante->id);
                })->get();
                $aprobado = false;
                foreach ($mdetalles as $mdetalle) {
                    # code...
                    array_push($notas,$mdetalle->nota);
                    if($mdetalle->nota > 12){
                        $aprobado = true;
                        break;
                    }
                }
                /* array_push($uni,[
                    'unidad'=>$unidade->nombre,
                    'notas'=>$notas,
                    'aprobado'=>$aprobado,
                ]); */
                array_push($uni,$aprobado);
            }
            
            array_push($array,[
                'estudiante'=>$estudiante->id,
                /* 'unidades'=>$uni, */
                'notas'=>!in_array(false,$uni),
            ]);
        }
        //ahora tenog el array para poner las notas
        $objetos = (object)$array;
        try {
            //code...
            foreach ($objetos as $key => $objeto) {
                # code...
                $estudiante = Estudiante::findOrFail($objeto['estudiante']);
                $estudiante->notas = $objeto['notas'];
                $estudiante->update();
            }
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
            //dd($th->getMessage());
        }
    }
}

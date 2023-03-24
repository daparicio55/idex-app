<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    public function index(Request $request)
    {
        //
        $programas = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $matriculas = Pmatricula::orderBy('nombre','desc')
        ->pluck('nombre','id')->toArray();
        $tipos = [
            'Unido'=>'Unido',
            'Separado'=>'Separado'
        ];
        
        if(isset($request->idCarrera)){
            $carrera = $request->idCarrera;
            $carr = Carrera::findOrFail($carrera);
            $matricula = $request->pmatricula_id;
            $periodo = Pmatricula::findOrFail($matricula);
            $ciclo = $request->ciclo;
            $tipo = $request->tipo;
            if($tipo == 'Unido'){
                $modulos = Udidactica::where('ciclo','=',$ciclo)
                ->whereRelation('modulo','carrera_id','=',$carrera)
                ->orderBy('nombre','asc')
                ->get();
 
                $matriculas = Ematricula::where('pmatricula_id','=',$matricula)
                ->get();
                
                $estudiantes = DB::table('ematriculas as ema')
                ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('admisiones as adm','adm.id','=','pos.admisione_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                ->where('ud.ciclo','=',$ciclo)
                ->where('mf.carrera_id','=',$carrera)
                ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
                ->orderBy('cli.apellido','asc')
                ->orderBy('cli.nombre','asc')
                ->get();


                $eestudiantes = DB::table('ematriculas as ema')
                ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('admisiones as adm','adm.id','=','pos.admisione_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                ->where('ud.ciclo','<>','V')
                ->where('ud.ciclo','<>','VI')
                ->where('mf.carrera_id','=',$carr->ccarrera_id)
                ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
                ->orderBy('cli.apellido','asc')
                ->orderBy('cli.nombre','asc')
                ->get();
                $ee = EmatriculaDetalle::whereHas('matricula',function($query) use($matricula){
                    $query->where('pmatricula_id','=',$matricula);
                })->whereHas('unidad.modulo',function($sql) use($ciclo,$carr){
                    $sql->where('carrera_id','=',$carr->ccarrera_id);
                })->get();         
                //dd($eestudiantes);
                return view('sacademica.ematriculas.nominas.completo',compact('carr','ciclo','estudiantes','modulos','periodo','eestudiantes'));
            }else{
                //aca vamos separado
                $carr = Carrera::findOrFail($carrera);
                $modulos = Udidactica::where('ciclo','=',$ciclo)
                ->whereRelation('modulo','carrera_id','=',$carrera)
                ->orderBy('nombre','asc')
                ->get();
                //lista de alumnos
                $estudiantes = DB::table('ematriculas as ema')
                ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre as unidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('admisiones as adm','adm.id','=','pos.admisione_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                ->where('ud.ciclo','=',$ciclo)
                ->where('emad.tipo','!=','Convalidacion')
                ->where('mf.carrera_id','=',$carrera)
                ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre')
                ->orderBy('unidad','asc')
                ->orderBy('cli.apellido','asc') 
                ->orderBy('cli.nombre','asc')
                ->get();


                $eestudiantes = DB::table('ematriculas as ema')
                ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre as unidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('admisiones as adm','adm.id','=','pos.admisione_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                //->where('ud.ciclo','=',$ciclo)
                ->where('emad.tipo','!=','Convalidacion')
                ->where('mf.carrera_id','=',$carr->ccarrera_id)
                ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre')
                ->orderBy('unidad','asc')
                ->orderBy('cli.apellido','asc') 
                ->orderBy('cli.nombre','asc')
                ->get();


                return view('sacademica.ematriculas.nominas.separado',compact('estudiantes','eestudiantes','modulos','carr','periodo','ciclo'));
            }
        }
        return view('sacademica.ematriculas.nominas.index',compact('programas','matriculas','tipos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Horario;
use App\Models\Uasignada;
use App\Models\Udidactica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudiantePEstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function notas(Request $request){
        $notas = DB::table('estudiantes as est')
        ->join('ematriculas as ema','ema.estudiante_id','=','est.id')
        ->join('ematricula_detalles as ema_de','ema_de.ematricula_id','ema.id')
        ->where('est.id','=',$request->estudiante)
        ->where('ema_de.udidactica_id','=',$request->unidad)
        ->get();
        return $notas;
    }
    public function buscardni($dni){
        //vamos a optener los datos del dni
        $programas = DB::table('estudiantes as est')
        ->select('cli.idCliente','cli.Apellido','cli.Nombre','cli.dniRuc','cli.direccion','cli.telefono','cli.telefono2','car.nombreCarrera as programa','est.id as estudiante_id','ad_post.sexo')
        ->join('admisione_postulantes as ad_post','ad_post.id','=','est.admisione_postulante_id')
        ->join('ccarreras as car','car.idCarrera','=','ad_post.idCarrera')
        ->join('clientes as cli','cli.idCliente','=','ad_post.idCliente')
        ->where('cli.dniRuc','=',$dni)
        ->get();
        return $programas;
    }
    public function datos($id){
        $datos = DB::table('estudiantes as est')
        ->select('ifor.creditos','car.idCarrera','adm.nombre as ingreso','cli.idCliente','cli.Apellido','cli.Nombre','cli.dniRuc','cli.direccion','cli.telefono','cli.telefono2','car.nombreCarrera as nombreCarrera','est.id as estudiante_id','ad_post.fechaNacimiento','ad_post.sexo','cli.email')
        ->join('admisione_postulantes as ad_post','ad_post.id','=','est.admisione_postulante_id')
        ->join('admisiones as adm','adm.id','=','ad_post.admisione_id')
        ->join('ccarreras as car','car.idCarrera','=','ad_post.idCarrera')
        ->join('iformativos as ifor','ifor.id','=','car.iformativo_id')
        ->join('clientes as cli','cli.idCliente','=','ad_post.idCliente')
        ->where('est.id','=',$id)
        ->get();
        return $datos;
    }
    public function unidadesfaltantes($id){
        $estudiante = Estudiante::findOrFail($id);
        //tengo que sacar todas las unidades
        $unidades = Udidactica::whereHas('modulo',function($query) use($estudiante){
            $query->where('carrera_id','=',$estudiante->postulante->carrera->idCarrera);
        })->get();
        $notas_unidades = [];
        foreach ($unidades as $unidade) {
            # code...
            //puedo buscar si esta unidad esta presente en el estudiante:
            $notas = EmatriculaDetalle::whereHas('matricula',function($query) use($unidade,$estudiante){
                $query->where('udidactica_id','=',$unidade->id)
                ->where('estudiante_id','=',$estudiante->id);
            })->get();
            //tengo que recorrer las notas
            $filas = EmatriculaDetalle::whereHas('matricula',function($query) use($unidade,$estudiante){
                $query->where('udidactica_id','=',$unidade->id)
                ->where('estudiante_id','=',$estudiante->id);
            })->count();
            $calificaciones = [];
            $salto = false;
            foreach ($notas as $nota) {
                if($nota->nota >12){
                    $salto = true;
                    break;
                }
                array_push($calificaciones,$nota->nota);
            }
            if($salto == false){
                array_push($notas_unidades,[
                    'id'=>$unidade->id,
                    'nombre'=>$unidade->nombre,
                    'tipo'=>$unidade->tipo,
                    'ciclo'=>$unidade->ciclo,
                    'creditos'=>$unidade->creditos,
                    'calificaciones'=>$calificaciones,
                ]);
            }
        }

        return  $notas_unidades;
        //tengo que sacar todas las unidades didacticas del la carrera

    }
    public function unidades($id){
        //
        $estudiante = DB::table('estudiantes as est')
        ->join('admisione_postulantes as ad_post','ad_post.id','=','est.admisione_postulante_id')
        ->where('est.id','=',$id)
        ->first();
        $unis = Udidactica::whereHas('modulo',function($query) use($estudiante){
            $query->where('carrera_id','=',$estudiante->idCarrera);
        })->orderBy('ciclo','asc')->get();
        
        $unidades = [];
        foreach ($unis as $uni) {
            # code...
            $horarios = [];
            if(isset($uni->equivalencia->id)){
                $uasignada = Uasignada::where('udidactica_id','=',$uni->equivalencia->id)
                ->where('pmatricula_id','=',100)
                ->first();
            }else{
                $uasignada = Uasignada::where('udidactica_id','=',$uni->id)
                ->where('pmatricula_id','=',100)
                ->first();
            }
            if(isset($uasignada->horarios)){
                foreach ($uasignada->horarios as $key => $horario) {
                    # code...
                    array_push($horarios,[
                        'dia'=>$horario->day,
                        'hinicio'=>$horario->hinicio,
                        'hfin'=>$horario->hfin
                    ]);
                }                
            }
            if (isset($uni->equivalencia->nombre)){
                //tenemos equivalencia y vamos a mandar el horario de la equivalencia
                array_push($unidades,[
                    'id'=>$uni->id,
                    'tipo'=>$uni->tipo,
                    'ciclo'=>$uni->ciclo,
                    'nombre'=>$uni->nombre.' - Equivalencia: '.$uni->equivalencia->nombre.' Ciclo: '.$uni->equivalencia->ciclo,
                    'creditos'=>$uni->creditos,
                    'horarios'=>$horarios
                ]);
            }else{
                array_push($unidades,[
                    'id'=>$uni->id,
                    'ciclo'=>$uni->ciclo,
                    'tipo'=>$uni->tipo,
                    'nombre'=>$uni->nombre,
                    'creditos'=>$uni->creditos,
                    'horarios'=>$horarios
                ]);
            }
        }
        return $unidades;
    }
    public function licencias($id){
        $estudiante = Estudiante::findOrFail($id);
        $m = [];
        foreach ($estudiante->matriculas as $matricula) {
            # code...
            $licencia = [];
            if(isset($matricula->li->id)){
                $reingreso = [];
                if(isset($matricula->li->reingreso->id)){
                    $reingreso = [
                        'id'=>$matricula->li->reingreso->id,
                        'fecha'=>$matricula->li->reingreso->fecha,
                        'observacion'=>$matricula->li->reingreso->observacion,
                    ];
                }
                $licencia = [
                    'id'=>$matricula->li->id,
                    'fecha'=>date('d-m-Y',strtotime($matricula->li->fecha)),
                    'observacion'=>$matricula->li->observacion,
                    'reingreso'=>$reingreso,
                ];
            }
            $m [] = [
                'id'=>$matricula->id,
                'fecha'=>$matricula->fecha,
                'tipo'=>$matricula->tipo,
                'periodo'=>$matricula->matricula->nombre,
                'licencia'=>$licencia,
            ];
        }
        $arr = [
            'dni'=>$estudiante->postulante->cliente->dniRuc,
            'apellido'=>$estudiante->postulante->cliente->apellido,
            'nombre'=>$estudiante->postulante->cliente->nombre,
            'telefono'=>$estudiante->postulante->cliente->telefono,
            'programa'=>$estudiante->postulante->carrera->nombreCarrera,
            'matriculas'=>$m
        ];
        return $arr;
    }
    public function checklicencia($id){
        //tenemos el estudiante
        $matriculas = Ematricula::where('estudiante_id','=',$id)
        ->orderBy('fecha','desc')
        ->get();
        $respuesta = false;
        //de forma rápida buscamos si tenemos licencias
        foreach ($matriculas as $key => $matricula) {
            # code...
            if ($matricula->licencia == "SI"){
                //ahora revizo si tiene un reingreso de esa licencia:
                if(!isset($matricula->li->reingreso->id))
                {
                    $respuesta = true;
                }
            }
        }
        $arr = [
            'message'=>$respuesta,
        ];
        return $arr;
    }
}

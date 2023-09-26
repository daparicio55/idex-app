<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
                ->where('pmatricula_id','=',91)
                ->first();
            }else{
                $uasignada = Uasignada::where('udidactica_id','=',$uni->id)
                ->where('pmatricula_id','=',91)
                ->first();
            }
            //return $uni->equivalencia->id;
            //dd($uasignada->horarios);
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
            //-------
            /* if(isset($uasignada->equivalencia->nombre)){
                $horarios = array_push($horarios,[
                    'dia'=>'Lunes',
                    'hinicio'=>"10:00:00",
                    'hfin'=>"12:00:00"
                ]);
            } */
            //-----
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
    
}

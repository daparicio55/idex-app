<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDeudaAdministradorExport;
use App\Models\Admisione;
use App\Models\Cliente;
use App\Models\Deuda;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Mformativo;
use App\Models\Pmatricula;
use App\Models\Practica;
use App\Models\Uasignada;
use App\Models\Ucliente;
use App\Models\Udidactica;
use App\Models\User;
use App\Services\DateService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function normalizarnombres(){
        try {
            //code...
            $clientes = Cliente::all();
            foreach ($clientes as $key => $cliente) {
                # code...
                $cliente->mayusculas();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'estado'=>'Fallo',
                'message'=>$th->getMessage()
            ];
        }
        return [
            'estado'=>'Listo',
            'message'=>'Nombres normalizados'
        ];
    }
    function set_null_licencias($pmatricula_id){
        $resultados = EmatriculaDetalle::whereHas('matricula',function($query) use($pmatricula_id){
                $query->where('pmatricula_id','=',$pmatricula_id)
                ->where('licencia','=','SI');
        })->update(['nota'=>null]);        
        return Redirect::route('administrador.index')->with('info',"se puso notas nulas a $resultados unidades didácticas con Licencias");
    }
    public function null_licencias($pmatricula_id){
        return $this->set_null_licencias($pmatricula_id);
    }
    function set_cero_inabilitados($pmatricula_id){
        $emdetalles = EmatriculaDetalle::whereHas('matricula',function($query) use($pmatricula_id){
                $query->where('pmatricula_id','=',$pmatricula_id);
        })->get();
        $inabilitados = [];
        foreach ($emdetalles as $emdetalle) {
                # code...
                $uasignada = Uasignada::where('pmatricula_id','=',$pmatricula_id)
                ->where('udidactica_id','=',$emdetalle->udidactica_id)
                ->first();
                $dateservices = new DateService();
                if(isset($uasignada->id)){
                        if($emdetalle->nota <> 0){
                                if($dateservices->inability($emdetalle->id,$uasignada)){
                                        if(!isset($emdetalle->matricula->li->id)){
                                                $emdetalle->nota = 0;
                                                $emdetalle->update();
                                                $inabilitados [] = [
                                                        'id'=>$emdetalle->id,
                                                        'dni'=>$emdetalle->matricula->estudiante->postulante->cliente->dniRuc,
                                                        'nombre'=>$emdetalle->matricula->estudiante->postulante->cliente->apellido.' ,'.$emdetalle->matricula->estudiante->postulante->cliente->nombre,
                                                        'programa'=>$emdetalle->matricula->estudiante->postulante->carrera->nombreCarrera,
                                                        'ciclo'=>$emdetalle->unidad->ciclo,
                                                        'unidad'=>$emdetalle->unidad->nombre,
                                                        'periodo'=>$emdetalle->matricula->matricula->nombre,
                                                        'nota'=>$emdetalle->nota
                                                ];
                                        }
                                };
                        }
                }
        }
        $cant = count($inabilitados);
        return Redirect::route('administrador.index')->with('info',"se supo CERO a $cant unidades didacticas"); 
    }
    public function index(){
        $admisiones = Admisione::orderBy('periodo','desc')->take(10)->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->take(10)->get();
        return view('administrador.index',compact('admisiones','periodos'));
    }
    public function reportematricula($id){
        $pmatricula = Pmatricula::findOrFail($id);
        return view('administrador.reportematricula',compact('pmatricula'));
    }
    public function masivemakeaccount($id){
        try {
            //code...
            $request = new Request();
        $estudiantes = Estudiante::whereHas('matriculas',function($query) use($id){
            $query->where('pmatricula_id','=',$id);
        })->get();
        //return $estudiantes;
        $users = [];
        $count = 0;
        foreach ($estudiantes as $estudiante) {
            # code...
            if(!isset($estudiante->postulante->cliente->ucliente->id)){
                $count ++;
                $estudiante = Estudiante::findOrFail($estudiante->id);
                $cliente = Cliente::findOrFail($estudiante->postulante->cliente->idCliente);
                //creamos la cuenta.
                $uss = User::where('email','=',$estudiante->postulante->cliente->email)->first();
                if(!isset($uss->id)){
                    //si no existe usuario con ese email entonces creamos el usuario
                    $user = new User();
                    $user->name = $cliente->nombre.', '.$cliente->apellido;
                    $user->email = $cliente->email;
                    $user->password = bcrypt('Pj'.$cliente->dniRuc);
                    $user->idOficina = 10;
                    $user->save();
                    $user->assignRole('Bolsa User');
                    //luego creamos el usuario intermedio entre la tabla usuarios y clientes Uclientes
                    $request->merge(['email' => $user->email]);
                    $ucliente = new Ucliente();
                    $ucliente->user_id = $user->id;
                    $ucliente->cliente_id = $cliente->idCliente;
                    $ucliente->save();
                    $a = [
                        'dni'=>$cliente->dniRuc,
                        'apellido'=>$cliente->apellido,
                        'nombre'=>$cliente->nombre,
                        'contraseña'=>'Pj'.$cliente->dniRuc,
                    ];
                    array_push($users,$a);
                }else{
                    //de existir el usuario entonces solo creamos la tabla intermedia;
                    
                    $request->merge(['email' => $uss->email]);
                    $ucliente = new Ucliente();
                    $ucliente->user_id = $uss->id;
                    $ucliente->cliente_id = $cliente->idCliente;
                    $ucliente->save();
                    $a = [
                        'dni'=>$cliente->dniRuc,
                        'apellido'=>$cliente->apellido,
                        'nombre'=>$cliente->nombre,
                        'contraseña'=>'Pj'.$cliente->dniRuc,
                    ];
                    array_push($users,$a);
                }
                //$this->sendReset($request);
            }
        }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        return view('administrador.masivemakeaccount',compact('users'));
    }
    public function reportedeudas(){
        $deudas = Deuda::orderBy('numero','desc')
        ->where('estado','=','deuda')
        ->get();
        return view('administrador.reportedeudas',compact('deudas'));
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
    public function reportedis($id){
        $periodo = Pmatricula::findOrfail($id);
        $matriculas = Ematricula::where('pmatricula_id','=',$id)
        ->whereHas('estudiante.postulante',function($query){
            $query->where('discapacidad','=',0);
        })
        ->get();
        return view('administrador.reportedis',compact('periodo','matriculas'));
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
                /* array_push($uni,[ kXhJZj]jyHjc1
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

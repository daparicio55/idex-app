<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapacidadeRequest;
use App\Http\Requests\CapacidadeStoreRequest;
use App\Models\Capacidade;
use App\Models\Uasignada;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;

class CapacidadeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cursos.capacidades.index')->only('index');
        $this->middleware('can:docentes.cursos.capacidades.create')->only('create','store');
        $this->middleware('can:docentes.cursos.capacidades.edit')->only('edit','update');
        $this->middleware('can:docentes.cursos.capacidades.destroy')->only('destroy');
        $this->middleware('can:docentes.cursos.capacidades.show')->only('show');
    }
    public function show($id){
        $capacidade = Capacidade::findOrFail($id);
        return view('docentes.cursos.capacidades.indicadores.index',compact('capacidade'));
    }
    public function create(Request $request){      
        $uasignada = Uasignada::findOrFail($request->asignacione);
        return view('docentes.cursos.capacidades.create',compact('uasignada'));
    }
    public function store(Request $request){
        try {
            //code...
            $capacidade = new Capacidade();
            $capacidade::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('info','se guardo la informacion correctamente');
    }
    public function destroy($id,CapacidadeRequest $re){
        //validar si se eliminar
        try {
            //code...
            $capacidade = Capacidade::findOrFail($id);
            $uasignada_id = $capacidade->uasignada_id;
            $capacidade->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$uasignada_id)->with('info','se elimino la capacidad correctamente');
    }
    public function edit($id){
        $capacidade = Capacidade::findOrFail($id);
        return view('docentes.cursos.capacidades.edit',compact('capacidade'));
    }
    public function u_capacidade($capacidade){
        $c = Capacidade::findOrFail($capacidade);
        $u = Uasignada::findOrFail($c->uasignada_id);
        $a_capacidade = [];
        $capacidades = $u->capacidades()->orderBy('nombre','asc')->get();
        foreach ($capacidades as $key => $capacidade) {
            array_push($a_capacidade,$capacidade->id);
        }
        $pos = array_search($c->id,$a_capacidade) + 1;
        if (count($a_capacidade)==1){
            //solo hay 1 indicador
            $a = [
                'orden'=> $pos,
                'primero'=>true,
                'ultimo'=>true,
                'unico'=>true,
                'id'=>$c->id,
                'id_anterior'=>null,
                'id_siguiente'=>null
            ];
        }else{
            if($pos == 1){
                $a = [
                    //es el numero 1;
                    'orden'=> $pos,
                    'primero'=>true,
                    'ultimo'=>false,
                    'unico'=>false,
                    'id'=>$c->id,
                    'id_anterior'=>null,
                    'id_siguiente'=>$a_capacidade[$pos]
                ];
            }else{
                if (count($a_capacidade)==$pos){
                    $a = [
                        //es el ultimo
                        'orden'=> $pos,
                        'primero'=>false,
                        'ultimo'=>true,
                        'unico'=>false,
                        'id'=>$c->id,
                        'id_anterior'=>$a_capacidade[$pos-2],
                        'id_siguiente'=>null
                    ];
                }else{
                    $a = [
                        'orden'=> $pos,
                        'primero'=>false,
                        'ultimo'=>false,
                        'unico'=>false,
                        'id'=>$c->id,
                        'id_anterior'=>$a_capacidade[$pos-2],
                        'id_siguiente'=>$a_capacidade[$pos]
                    ];
                }
            }
        }
        return $a; 
    }

    public function verificarFecha($capacidade,$fecha){
        $arMessage = [
            "estado"=>false,
            "mensage"=>"OK",
        ];
        $c = Capacidade::findOrFail($capacidade);
        $ar = $this->u_capacidade($capacidade);

        $fechaCapacidad = Carbon::createFromFormat('Y-m-d',$fecha);
        $fechaCiclo = Carbon::createFromFormat('Y-m-d',$c->uasignada->periodo->ffin);
        if ($ar["unico"]){
            if($fechaCapacidad->gt($fechaCiclo)){
                //verificamos si no pasa el final del ciclo:
                $arMessage["estado"] = true;
                $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del periodo academico";
            }
        }else{
            if($ar["primero"]){           
                //verificamos si no pasa el final de la capacidad:
                if($fechaCapacidad->gt($fechaCiclo)){
                    $arMessage["estado"] = true;
                    $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del periodo academico";
                }else{
                    //verificanos que la sigueinte fecha no sea nula
                    $c_siguiente = Capacidade::findOrFail($ar['id_siguiente']);
                    if(isset($c_siguiente->fecha)){
                        $fechaSiguiente = Carbon::createFromFormat('Y-m-d',$c_siguiente->fecha);
                        if($fechaCapacidad->gt($fechaSiguiente)){
                            $arMessage["estado"] = true;
                            $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha del siguiente capacidad";
                        }
                    }
                }
            }else{
                if($ar["ultimo"]){
                    if($fechaCapacidad->gt($fechaCiclo)){
                        //verificamos si no pasa el final de ciclo:
                        $arMessage["estado"] = true;
                        $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del periodo academico";
                    }else{
                        //buscamos el indicador anterior
                        $c_anterior = Capacidade::findOrFail($ar["id_anterior"]);
                        if(isset($c_anterior->fecha)){
                            $fechaAnterior = Carbon::createFromFormat('Y-m-d',$c_anterior->fecha);
                            if($fechaAnterior->gt($fechaCapacidad)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "La fecha no puede ser menor a la fecha de la capacidad anterior";
                            }
                        }else{
                            $arMessage["estado"] = true;
                            $arMessage["mensage"] = "no puedes ingresar la fecha de esta capacidad sin ingresar la capacidad anterior";
                        }
                    }
                }else{
                    //ahora si no es ultuimos
                    $c_anterior = Capacidade::findOrFail($ar["id_anterior"]);
                    $c_siguiente = Capacidade::findOrFail($ar['id_siguiente']);
                    //ahora tengo que verificar que la fecha este entre las fecha de inicio y fin
                    if(isset($c_anterior->fecha)){
                        $fechaAnterior = Carbon::createFromFormat('Y-m-d',$c_anterior->fecha);
                        if(isset($c_siguiente->fecha)){
                            $fechaSiguiente = Carbon::createFromFormat('Y-m-d',$c_siguiente->fecha);
                            if($fechaAnterior->gt($fechaCapacidad)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "no puedes ingresar una fecha anterior a la capacidad";
                            }
                            if($fechaCapacidad->gt($fechaSiguiente)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "no puedes ingresar una fecha posterior a la capacidad";
                            }
                        }else{
                            if($fechaAnterior->gt($fechaCapacidad)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "la fecha no puede ser menor a la de la capacidad anterior";
                            }
                        }
                    }else{
                        $arMessage["estado"] = true;
                        $arMessage["mensage"] = "no puedes ingresar la fecha de esta capacidad sin ingresar la capacidad anterior";
                    }
                }
            }
        }
        return $arMessage;
    }



    public function update(Request $request,$id){
        try {
            //code...
            $capacidade = Capacidade::findOrFail($id);
            $uasignada = Uasignada::findOrFail($capacidade->uasignada_id);
            $respuesta = $this->verificarFecha($id,$request->fecha);
            if($respuesta['estado']){
                throw new Exception($respuesta["mensage"]);
            }
            $capacidade->fecha = $request->fecha;
            $capacidade->update();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$capacidade->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$capacidade->uasignada_id)->with('info','se actualizo la fecha correctamente de la capacidad');
    }
}

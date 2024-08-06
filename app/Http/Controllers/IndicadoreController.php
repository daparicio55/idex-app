<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalificarStoreRequest;
use App\Models\Capacidade;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Indicadore;
use App\Models\IndicadoreDetalle;
use App\Models\Uasignada;
use App\Models\Udidactica;
use App\Services\DateService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IndicadoreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cursos.capacidades.indicadores.index')->only('index');
        $this->middleware('can:docentes.cursos.capacidades.indicadores.create')->only('create','store');
        $this->middleware('can:docentes.cursos.capacidades.indicadores.edit')->only('edit','update');
        $this->middleware('can:docentes.cursos.capacidades.indicadores.destroy')->only('destroy');
        $this->middleware('can:docentes.cursos.capacidades.indicadores.show')->only('show');
    }
    public function create(Request $request){
        $capacidade = Capacidade::findOrFail($request->capacidade_id);
        return view('docentes.cursos.capacidades.indicadores.create',compact('capacidade'));
        
    }
    public function store(Request $request){
        /* try {
            //code...
            return $request;
            $indicadore = new Indicadore();
            $indicadore->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('info','se guardo el indicador correctamente'); */
    }
    public function edit($id){
        $indicadore = Indicadore::findOrFail($id);
        return view('docentes.cursos.capacidades.indicadores.edit',compact('indicadore'));
    }
    public function u_indicador($indicador){
        $i = Indicadore::findOrFail($indicador);
        $c = Capacidade::findOrFail($i->capacidade_id);
        $a_indicadores = [];
        $indicadores = $c->indicadores()->orderBy('nombre','asc')->get();
        foreach ($indicadores as $key => $indicador) {
            array_push($a_indicadores,$indicador->id);
        }
        $pos = array_search($i->id,$a_indicadores) + 1;
        if (count($a_indicadores)==1){
            //solo hay 1 indicador
            $a = [
                'orden'=> $pos,
                'primero'=>true,
                'ultimo'=>true,
                'unico'=>true,
                'id'=>$i->id,
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
                    'id'=>$i->id,
                    'id_anterior'=>null,
                    'id_siguiente'=>$a_indicadores[$pos]
                ];
            }else{
                if (count($a_indicadores)==$pos){
                    $a = [
                        //es el ultimo
                        'orden'=> $pos,
                        'primero'=>false,
                        'ultimo'=>true,
                        'unico'=>false,
                        'id'=>$i->id,
                        'id_anterior'=>$a_indicadores[$pos-2],
                        'id_siguiente'=>null
                    ];
                }else{
                    $a = [
                        'orden'=> $pos,
                        'primero'=>false,
                        'ultimo'=>false,
                        'unico'=>false,
                        'id'=>$i->id,
                        'id_anterior'=>$a_indicadores[$pos-2],
                        'id_siguiente'=>$a_indicadores[$pos]
                    ];
                }
            }
        }
        return $a;
    }
    public function verificarFecha($indicador,$fecha){
        $arMessage = [
            "estado"=>false,
            "mensage"=>"OK",
        ];
        $i = Indicadore::findOrFail($indicador);
        $ar = $this->u_indicador($indicador);
        $fechaCapacidad = Carbon::createFromFormat('Y-m-d',$i->capacidade->fecha);
        $fechaIndicador = Carbon::createFromFormat('Y-m-d',$fecha);
        if ($ar["unico"]){
            if($fechaIndicador->gt($fechaCapacidad)){
                //verificamos si no pasa el final del indicador:
                $arMessage["estado"] = true;
                $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del indicador";
            }
        }else{
            if($ar["primero"]){           
                //verificamos si no pasa el final de la capacidad:
                if($fechaIndicador->gt($fechaCapacidad)){
                    $arMessage["estado"] = true;
                    $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del indicador";
                }else{
                    //verificanos que la sigueinte fecha no sea nula
                    $i_siguiente = Indicadore::findOrFail($ar['id_siguiente']);
                    if(isset($i_siguiente->fecha)){
                        $fechaSiguiente = Carbon::createFromFormat('Y-m-d',$i_siguiente->fecha);
                        if($fechaIndicador->gt($fechaSiguiente)){
                            $arMessage["estado"] = true;
                            $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha del siguiente indicador";
                        }
                    }
                }
                
            }else{
                if($ar["ultimo"]){
                    if($fechaIndicador->gt($fechaCapacidad)){
                        //verificamos si no pasa el final del indicador:
                        $arMessage["estado"] = true;
                        $arMessage["mensage"] = "La fecha no puede ser mayor a la fecha limite del indicador";
                    }else{
                        //buscamos el indicador anterior
                        $i_anterior = Indicadore::findOrFail($ar["id_anterior"]);
                        if(isset($i_anterior->fecha)){
                            $fechaAnterior = Carbon::createFromFormat('Y-m-d',$i_anterior->fecha);
                            if($fechaAnterior->gt($fechaIndicador)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "La fecha no puede ser menor a la fecha del indicador anterior";
                            }
                        }else{
                            $arMessage["estado"] = true;
                            $arMessage["mensage"] = "no puedes ingresar la fecha de esde indicador sin ingresar el indicador anterior";
                        }
                    }
                }else{
                    //ahora si no es ultuimos
                    $i_anterior = Indicadore::findOrFail($ar["id_anterior"]);
                    $i_siguiente = Indicadore::findOrFail($ar['id_siguiente']);
                    //ahora tengo que verificar que la fecha este entre las fecha de inicio y fin
                    if(isset($i_anterior->fecha)){
                        $fechaAnterior = Carbon::createFromFormat('Y-m-d',$i_anterior->fecha);
                        if(isset($i_siguiente->fecha)){
                            $fechaSiguiente = Carbon::createFromFormat('Y-m-d',$i_siguiente->fecha);
                            if($fechaAnterior->gt($fechaIndicador)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "no puedes ingresar una fecha anterior al indicador";
                            }
                            if($fechaIndicador->gt($fechaSiguiente)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "no puedes ingresar una fecha posterior al indicador";
                            }
                        }else{
                            if($fechaAnterior->gt($fechaIndicador)){
                                $arMessage["estado"] = true;
                                $arMessage["mensage"] = "la fecha no puede ser menor a la del indicador anterior";
                            }
                        }
                    }else{
                        $arMessage["estado"] = true;
                        $arMessage["mensage"] = "no puedes ingresar la fecha de esde indicador sin ingresar el indicador anterior";
                    }
                }
            }
        }
        return $arMessage;
    }
    public function update(Request $request,$id){
        try {
            $indicadoree = Indicadore::findOrFail($id);
            $respuesta = $this->verificarFecha($id,$request->fecha);
            if ($respuesta["estado"]){
                throw new Exception($respuesta["mensage"]);
            }
            
            $indicadoree->fecha = $request->fecha;
            $indicadoree->update();
        } catch (\Throwable $th) {
            return Redirect::route('docentes.cursos.show',$indicadoree->capacidade->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$indicadoree->capacidade->uasignada_id)->with('info','Se actualizo el indicador correctamente');
    }
    public function destroy($id){
        try {
            //code...
            $indicadore = Indicadore::findOrFail($id);
            $capacidade_id = $indicadore->capacidade_id;
            $indicadore->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.capacidades.show',$capacidade_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.capacidades.show',$capacidade_id)->with('info','se actualizo el indicador correctamente');
    }
    public function show(){

    }
    public function calificar($id){
        //debo devolver una vista con la lista de alumnos matriculados
        //$criterio = Criterio::findOrFail($id);
        $indicadore = Indicadore::findOrFail($id);
        //tengo que poner la unidad didactica de equivalencia.
               
        $estudiantes = Ematricula::select('clientes.nombre','clientes.dniRuc','clientes.apellido','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$indicadore->capacidade->uasignada->udidactica_id)
        ->where('ematriculas.pmatricula_id','=',$indicadore->capacidade->uasignada->pmatricula_id)
        ->where(function($query){
            $query->where('ematricula_detalles.tipo','Regular')->orWhere('ematricula_detalles.tipo','Repitencia');
        })
        /* ->where('ematriculas.licencia','=','NO') */
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        
        if(isset($indicadore->capacidade->uasignada->unidad->old->id)){
            $equivalencias = Ematricula::select('clientes.nombre','clientes.dniRuc','clientes.apellido','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
            ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
            ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
            ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
            ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
            ->where('ematricula_detalles.udidactica_id','=',$indicadore->capacidade->uasignada->unidad->old->id)
            ->where('ematriculas.pmatricula_id','=',$indicadore->capacidade->uasignada->pmatricula_id)
            ->where(function($query){
                $query->where('ematricula_detalles.tipo','Regular')->orWhere('ematricula_detalles.tipo','Repitencia');
            })
            ->orderBy('clientes.apellido')
            ->orderBy('clientes.nombre')
            ->get();
        }else{
            $equivalencias = null;
        }
        return view('docentes.cursos.capacidades.indicadores.calificar',compact('estudiantes','equivalencias','indicadore'));
    }
    public function calificarStore(CalificarStoreRequest $request,$indicadore_id){
        try {
            //code...
            DB::beginTransaction();
            $indicadore = Indicadore::findOrFail($indicadore_id);
            $cantidad = count($request->ematricula_detalle_id);
            for($i=0;$i<$cantidad;$i++){
                $detalle = IndicadoreDetalle::updateOrCreate(
                    ['ematricula_detalle_id'=>$request->ematricula_detalle_id[$i],'indicadore_id'=>$indicadore_id],
                    ['nota'=>$request->notas[$i],'fecha'=>Carbon::now(),'user_id'=>auth()->id()]
                );
            }
            DB::commit();

            for($i=0;$i<$cantidad;$i++){
                $dateService = new DateService();
                $estudiantematriculadetalle = EmatriculaDetalle::findOrFail($request->ematricula_detalle_id[$i]);
                $unidad = Udidactica::findOrFail($estudiantematriculadetalle->udidactica_id);
                if(isset($unidad->equivalencia->id)){
                    $uasignada = Uasignada::where('udidactica_id','=',$unidad->equivalencia->id)
                    ->where('pmatricula_id','=',$estudiantematriculadetalle->matricula->pmatricula_id)
                    ->first();
                }else{
                    $uasignada = Uasignada::where('udidactica_id','=',$unidad->id)
                    ->where('pmatricula_id','=',$estudiantematriculadetalle->matricula->pmatricula_id)
                    ->first();
                }
                $cont=0;
                $sum=0;
                $pro=0;
                if($dateService->inability($estudiantematriculadetalle->id,$uasignada)){
                    $estudiantematriculadetalle->nota = 0;
                    $estudiantematriculadetalle->update();
                }else{
                    foreach ($uasignada->capacidades as $capacidade){
                        $nota = 0;
                        $suma = 0;
                        $contador = 0;
                            foreach ($capacidade->indicadores as $indicadore){
                                $suma = $suma + number_format(indicador_calificacion($indicadore->id, $estudiantematriculadetalle->id),2,'.','');
                                $contador ++;
                            }
                        $nota = $suma / (($contador == 0) ? 1 : $contador);
                        //$nota = round(number_format($nota,2,'.',''),0);
                        $nota = number_format(round($nota,0),0);
                        $sum = $sum + $nota;
                        $cont++;
                    }
                    $pro = $sum / (($cont == 0) ? 1 : $cont);
                    //$pro = round(number_format($pro,2,'.',''),0);
                    $pro = number_format(round($pro,0),0);
                    $estudiantematriculadetalle->nota = $pro;
                    $estudiantematriculadetalle->update();
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::route('docentes.cursos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.index')->with('info','se actualizo el indicador correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalificarStoreRequest;
use App\Models\Capacidade;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Indicadore;
use App\Models\IndicadoreDetalle;
use App\Models\Uasignada;
use Carbon\Carbon;
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
        //dd($capacidade);
        return view('docentes.cursos.capacidades.indicadores.create',compact('capacidade'));
        
    }
    public function store(Request $request){
        try {
            //code...
            //dd($request->capacidade_id);
            $indicadore = new Indicadore();
            $indicadore->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('info','se guardo el indicador correctamente');
    }
    public function edit($id){
        $indicadore = Indicadore::findOrFail($id);
        return view('docentes.cursos.capacidades.indicadores.edit',compact('indicadore'));
    }
    public function update(Request $request,$id){
        try {
            //code...
            $indicadore = Indicadore::findOrFail($id);
            $indicadore->nombre = $request->nombre;
            $indicadore->descripcion = $request->descripcion;
            $indicadore->fecha = $request->fecha;
            $indicadore->update();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.capacidades.show',$request->capacidade_id)->with('info','se actualizo el indicador correctamente');
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
        //dd($equivalencias);
        //dd($estudiantes->toSql());
        //dd($criterio->asignacione->unidad->old->id);
        return view('docentes.cursos.capacidades.indicadores.calificar',compact('estudiantes','equivalencias','indicadore'));
    }
    public function calificarStore(CalificarStoreRequest $request,$indicadore_id){
        try {
            //code...
            DB::beginTransaction();
            $indicadore = Indicadore::findOrFail($indicadore_id);
            //$criterio = Criterio::findOrFail($criterio_id);
            $cantidad = count($request->ematricula_detalle_id);
            for($i=0;$i<$cantidad;$i++){
                $detalle = IndicadoreDetalle::updateOrCreate(
                    ['ematricula_detalle_id'=>$request->ematricula_detalle_id[$i],'indicadore_id'=>$indicadore_id],
                    ['nota'=>$request->notas[$i],'fecha'=>Carbon::now(),'user_id'=>auth()->id()]
                );
                $uasignada = Uasignada::findOrFail($detalle->indicador->capacidade->uasignada->id);
                $contadorcapacidades = 0;
                $sumacapacidades = 0;
                foreach ($uasignada->capacidades as $capacidade) {
                    # code...
                    //recorremos las capacidades
                    $promediodetalles = 0;
                    foreach ($capacidade->indicadores as $indicadore) {
                        # recorremos los indicadores
                        $details = $indicadore->detalles()->where('ematricula_detalle_id','=',$request->ematricula_detalle_id[$i])->get();
                        $sumadetalles = 0;
                        $cantidaddetalles = 0;
                        foreach ($details as $detail) {
                            //aca tenemos las notas
                            $sumadetalles = $sumadetalles + intval($detail->nota);
                            //dd($sumadetalles);
                            $cantidaddetalles ++;
                        }
                        $promediodetalles = round($sumadetalles / (($cantidaddetalles == 0) ? 1 : $cantidaddetalles),0);
                        $sumacapacidades = $sumacapacidades + $promediodetalles;
                        $contadorcapacidades ++;
                    }
                }
                $promediocapacidades = round($sumacapacidades / $contadorcapacidades,0);
                $ematricula = EmatriculaDetalle::findOrFail($request->ematricula_detalle_id[$i]);
                $ematricula->nota = $promediocapacidades;
                $ematricula->update();
            }
            //vamos a actualizar las notas de ese indicador
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            //return Redirect::route('docentes.cursos.show',$criterio->uasignada_id)->with('error',$th->getMessage());
            return Redirect::route('docentes.cursos.capacidades.show',$indicadore->capacidade_id)->with('error',$th->getLine());
        }
        return Redirect::route('docentes.cursos.capacidades.show',$indicadore->capacidade_id)->with('info','se actualizo el indicador correctamente');
        //return Redirect::route('docentes.cursos.show',$criterio->uasignada_id)->with('info','se gardaron las notas correctamente');
    }
}

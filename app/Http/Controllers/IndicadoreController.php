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
use Carbon\Carbon;
use DragonCode\Support\Facades\Helpers\Arr;
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

        //dd($id);
        try {
            //code...
            $indicadoree = Indicadore::findOrFail($id);
            $request->validate([
                'fecha'=>'required|before_or_equal:'.$indicadoree->capacidade->fecha
            ]);
            $capacidade = Capacidade::findOrFail($indicadoree->capacidade_id);
            foreach ($capacidade->indicadores as $key => $indicadore) {
                # code...
                if ($key != 0){
                    $fecha = Carbon::parse($request->fecha);
                    $fanterior = Carbon::parse($capacidade->indicadores[$key-1]->fecha);
                    if($fecha->lessThanOrEqualTo($fanterior)){
                        throw new Exception('La fecha no puede ser igual o menor a la del anterior indicador');
                    }
                }
            }
            $indicadoree->fecha = $request->fecha;
            $indicadoree->update();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.index')->with('info','Se actualizo el indicador correctamente');
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
            $cantidad = count($request->ematricula_detalle_id);
            for($i=0;$i<$cantidad;$i++){
                $detalle = IndicadoreDetalle::updateOrCreate(
                    ['ematricula_detalle_id'=>$request->ematricula_detalle_id[$i],'indicadore_id'=>$indicadore_id],
                    ['nota'=>$request->notas[$i],'fecha'=>Carbon::now(),'user_id'=>auth()->id()]
                );
            }
            DB::commit();
            for($i=0;$i<$cantidad;$i++){
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
                foreach ($uasignada->capacidades as $capacidade){
                    $nota = 0;
                    $suma = 0;
                    $contador = 0;
                        foreach ($capacidade->indicadores as $indicadore){
                            $suma = $suma + number_format(indicador_calificacion($indicadore->id, $estudiantematriculadetalle->id),2,'.','');
                            $contador ++;
                        }
                    $nota = $suma / (($contador == 0) ? 1 : $contador);
                    $nota = round(number_format($nota,2,'.',''),0);
                    $sum = $sum + $nota;
                    $cont++;
                }
                $pro = $sum / (($cont == 0) ? 1 : $cont);
                $pro = round(number_format($pro,2,'.',''),0);
                $estudiantematriculadetalle->nota = $pro;
                $estudiantematriculadetalle->update();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::route('docentes.cursos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.index')->with('info','se actualizo el indicador correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Criterio;
use App\Models\CriterioDetalle;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Uasignada;
use Carbon\Carbon;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CriterioController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $asignacione = Uasignada::findOrFail($request->asignacione);
        return view('docentes.cursos.criterios.create',compact('asignacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            $criterio = new Criterio();
            $criterio->uasignada_id = $request->uasignada_id;
            $criterio->nombre = $request->nombre;
            $criterio->descripcion = $request->descripcion;
            $criterio->fecha = Carbon::now();
            $criterio->save();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('info','se guardo el criterio correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function calificar($id){
        //debo devolver una vista con la lista de alumnos matriculados
        $criterio = Criterio::findOrFail($id);
        //tengo que poner la unidad didactica de equivalencia.
               
        $estudiantes = Ematricula::select('clientes.nombre','clientes.apellido','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$criterio->asignacione->udidactica_id)
        ->where('ematriculas.pmatricula_id','=',$criterio->asignacione->pmatricula_id)
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        $equivalencias = Ematricula::select('clientes.nombre','clientes.apellido','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$criterio->asignacione->unidad->old->id)
        ->where('ematriculas.pmatricula_id','=',$criterio->asignacione->pmatricula_id)
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        //dd($equivalencias);
        //dd($estudiantes->toSql());
        //dd($criterio->asignacione->unidad->old->id);
        return view('docentes.cursos.criterios.calificar',compact('estudiantes','criterio'));
    }
    public function calificarStore(Request $request,$criterio_id){
        try {
            //code...
            DB::beginTransaction();
            $criterio = Criterio::findOrFail($criterio_id);
            $cantidad = count($request->ematricula_detalle_id);
            for($i=0;$i<$cantidad;$i++){
                CriterioDetalle::updateOrCreate(
                    ['ematricula_detalle_id'=>$request->ematricula_detalle_id[$i],'criterio_id'=>$criterio_id],
                    ['nota'=>$request->notas[$i],'fecha'=>Carbon::now(),'user_id'=>auth()->id()]
                );
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('docentes.cursos.show',$criterio->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$criterio->uasignada_id)->with('info','se gardaron las notas correctamente');
    }
}

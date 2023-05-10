<?php

namespace App\Http\Controllers;

use App\Models\Capacidade;
use App\Models\Criterio;
use App\Models\Ematricula;
use App\Models\Uasignada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DocenteCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cursos.index')->only('index');
        $this->middleware('can:docentes.cursos.create')->only('create','store');
        $this->middleware('can:docentes.cursos.edit')->only('edit','update');
        $this->middleware('can:docentes.cursos.destroy')->only('destroy');
        $this->middleware('can:docentes.cursos.show')->only('show');
        $this->middleware('can:docentes.cursos.imprimir')->only('imprimir');
        $this->middleware('can:docentes.cursos.equivalencia')->only('equivalencia');
    }
    public function index()
    {
        $asignaciones = Uasignada::where('user_id','=',auth()->id())
        ->get();
        return view('docentes.cursos.index',compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $asignacione = Uasignada::findOrFail($id);
        //vamos buscar las capacidades
        $capacidades = Capacidade::where('uasignada_id','=',$asignacione->id)->get();
        return view('docentes.cursos.capacidades.index',compact('asignacione','capacidades'));
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
    public function imprimir($id){
        $uasignada = Uasignada::findOrFail($id);
        //tengo que poner la unidad didactica de equivalencia.
        $estudiantes = Ematricula::select('ematriculas.licencia','ematriculas.licenciaObservacion','clientes.nombre','clientes.apellido','clientes.dniRuc','admisiones.periodo','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('admisiones','admisione_postulantes.admisione_id','=','admisiones.id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$uasignada->udidactica_id)
        ->where('ematriculas.pmatricula_id','=',$uasignada->pmatricula_id)
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();


        $equivalencias = Ematricula::select('ematriculas.licencia','ematriculas.licenciaObservacion','clientes.nombre','clientes.apellido','clientes.dniRuc','admisiones.periodo','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('admisiones','admisione_postulantes.admisione_id','=','admisiones.id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$uasignada->unidad->old->id)
        ->where('ematriculas.pmatricula_id','=',$uasignada->pmatricula_id)
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        return view('docentes.cursos.imprimir',compact('uasignada','estudiantes'));
    }
    public function equivalencia($id){
        $uasignada = Uasignada::findOrFail($id);
        $estudiantes = Ematricula::select('ematriculas.licencia','ematriculas.licenciaObservacion','clientes.nombre','clientes.apellido','clientes.dniRuc','admisiones.periodo','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('admisiones','admisione_postulantes.admisione_id','=','admisiones.id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.udidactica_id','=',$uasignada->unidad->old->id)
        ->where('ematriculas.pmatricula_id','=',$uasignada->pmatricula_id)
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        return view('docentes.cursos.equivalencia',compact('uasignada','estudiantes'));
    }
}

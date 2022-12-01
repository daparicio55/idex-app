<?php

namespace App\Http\Controllers;

use App\Models\Ematricula;
use App\Models\Pmatricula;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('can:admisiones.configuraciones.index')->only('index');
        $this->middleware('can:admisiones.configuraciones.create')->only('create','store');
        $this->middleware('can:admisiones.configuraciones.edit')->only('edit','update');
        $this->middleware('can:admisiones.configuraciones.destroy')->only('destroy');
        $this->middleware('can:admisiones.configuraciones.show')->only('show');
        $this->middleware('can:admisiones.configuraciones.anular')->only('anular'); */
    }
    public function index(Request $request)
    {
        //
        $periodos = Pmatricula::pluck('nombre','id')->toArray();
        if(isset($request->id)){
            $matriculados = Ematricula::where('pmatricula_id','=',$request->id)->get();
            return view('sacademica.estadisticas.index',compact('periodos','matriculados'));
        }
        return view('sacademica.estadisticas.index',compact('periodos'));
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
}

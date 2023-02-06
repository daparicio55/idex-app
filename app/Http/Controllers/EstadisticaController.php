<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
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
        $this->middleware('can:sacademica.estadisticas.index')->only('index');
        $this->middleware('can:sacademica.estadisticas.create')->only('create','store');
        $this->middleware('can:sacademica.estadisticas.edit')->only('edit','update');
        $this->middleware('can:sacademica.estadisticas.destroy')->only('destroy');
        $this->middleware('can:sacademica.estadisticas.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $periodos = Pmatricula::orderBy('nombre','desc')->pluck('nombre','id')->toArray();
        if(isset($request->id)){
            /* $carreras = Carrera::whereHas('postulantes.estudiante.matriculas',function($query){
                $query->where('pmatricula_id',68);
            })->get(); */
            /* dd($carreras[2]->postulantes()->get()); */
            /* $carrera = Carrera::find(8);
            return $carrera->postulantes()->estudiantes()->get(); */     
            $carreras = Carrera::orderBy('nombreCarrera','asc')->get();
            return view('sacademica.estadisticas.index',compact('periodos','carreras'));
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

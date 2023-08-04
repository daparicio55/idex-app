<?php

namespace App\Http\Controllers;

use App\Exports\ReporteMatriculaExport;
use App\Models\Carrera;
use App\Models\Pmatricula;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $ciclos = ["I","II","III","IV","V","VI"];
        
        $ciclos = (object)$ciclos;
        ///dd($ciclos);
        $periodos = Pmatricula::orderBy('nombre','desc')->pluck('nombre','id')->toArray();
        if(isset($request->id)){
            
            $carreras = Carrera::orderBy('nombreCarrera','asc')->get();
            //$matriculas = Ematricula::where('pmatricula_id','=',$request->id)->get();
            
            //dd($matriculas);
            return view('sacademica.estadisticas.index',compact('periodos','carreras','ciclos'));
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
        //dd($id);
        $periodo = Pmatricula::findOrFail($id);
        return Excel::download(new ReporteMatriculaExport($id),'periodo-'.$periodo->nombre.'.xlsx');
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

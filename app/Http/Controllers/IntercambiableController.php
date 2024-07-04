<?php

namespace App\Http\Controllers;

use App\Models\Intercambiable;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IntercambiableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    private function getUnidades()
    {
        $unidades = Udidactica::whereHas('modulo.itinerario',function($q){
            $q->where('iformativos.id','=',4);
        })
        ->Where('tipo','=','Empleabilidad')
        ->orderBy('mformativo_id','desc')
        ->orderBy('tipo','asc')
        ->orderBy('ciclo','asc')
        ->get();
        return $unidades;
    }
    public function index()
    {
        //
        $intercambiables = Intercambiable::get();
        return view('sacademica.planificacion.intercambiables.index',compact('intercambiables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = $this->getUnidades();
        return view('sacademica.planificacion.intercambiables.create',compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'unidades'=>'array|required',
        ]);
        //return $request->unidades;
        try {
            //code...
        
            $intercambiable = new Intercambiable();
            $intercambiable->nombre = $request->nombre;
            $intercambiable->save();
            $intercambiable->unidades()->attach($request->unidades);

           
        } catch (\Throwable $th) {
            //throw $th;
            
            return $th->getMessage();
            return Redirect::route('sacademica.intercambiables.index')->with('error','Error al crear los cursos intercambiables');
        }
        return Redirect::route('sacademica.intercambiables.index')->with('info','Cursos intercambiables creados con éxito');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $intercambiable = Intercambiable::find($id);
        $unidades = $this->getUnidades();
        return view('sacademica.planificacion.intercambiables.edit',compact('intercambiable','unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //       
        try {
            //code...
            $intercambiable = Intercambiable::findOrFail($id);
            $intercambiable->nombre = $request->nombre;
            $intercambiable->update();
            $intercambiable->unidades()->sync($request->unidades);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('sacademica.intercambiables.index')->with('error','Error al actualizar los cursos intercambiables'); 
        }
        return Redirect::route('sacademica.intercambiables.index')->with('info','Cursos intercambiables actualizados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

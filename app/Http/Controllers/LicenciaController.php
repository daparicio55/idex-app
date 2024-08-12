<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\Estudiante;
use App\Models\Licencia;
use App\Models\Pmatricula;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LicenciaController extends Controller
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
        $licencias = Licencia::orderBy('id','desc')->get();
        $programas = Carrera::orderby('observacionCarrera','desc')->orderBy('nombreCarrera','asc')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        return view('sacademica.licencias.index',compact('licencias','programas','periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sacademica.licencias.create');
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
        $request->validate([
            'licencia'=>'required',
            'observacion'=>'required'
        ]);
        try {
            //code...
            DB::beginTransaction();
            $licencia = Licencia::findOrFail($request->licencia);
            $licencia->observacion = $request->observacion;
            $matricula = Ematricula::findOrFail($licencia->matricula->id);
            $matricula->licenciaObservacion = $request->observacion;
            $matricula->update();
            DB::commit();
            
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('sacademica.licencias.index')->with('error','error al intentar actualizar la resolucion');
        }
        return Redirect::route('sacademica.licencias.index')->with('info','Se actualizo la resolucion correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        return $request;
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
        try {
            //code...
            DB::beginTransaction();
            $licencia = new Licencia();
            $licencia->user_id = auth()->id();
            $licencia->observacion = $request->observacion;
            $licencia->fecha = Carbon::now();
            $licencia->ematricula_id = $id;
            $licencia->save();
            //updateamos la licencia
            $matricula = Ematricula::findOrFail($id);
            $matricula->licencia = "SI";
            $matricula->licenciaObservacion = $request->observacion;
            $matricula->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('sacademica.licencias.index')->with('error',$th->getMessage());    
        }
        return Redirect::route('sacademica.licencias.index')->with('info','licencia registrada correctamente');
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
        try {
            //code...
            DB::beginTransaction();
            $licencia = Licencia::findOrFail($id);
            $licencia->delete();
            //ahora hay que revertir la anterior tabla
            $matricula = Ematricula::findOrFail($licencia->ematricula_id);
            $matricula->licencia = "NO";
            $matricula->licenciaObservacion ="";
            $matricula->update();
            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();            
            return Redirect::route('sacademica.licencias.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.licencias.index')->with('info','se eliminó la licencia correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Pmatricula;
use App\Models\Reingreso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReingresoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $reingresos = Reingreso::orderBy('fecha','desc')->get();
        $programas = Carrera::orderby('observacionCarrera','desc')->orderBy('nombreCarrera','asc')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        return view('sacademica.reingresos.index',compact('reingresos','programas','periodos'));
    }
    public function create(){
        return view('sacademica.reingresos.create');
    }
    public function store(Request $request){
        try {
            //code...
            $reingreso = Reingreso::findOrFail($request->reingreso);
            $reingreso->observacion = $request->observacion;
            $reingreso->update();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('sacademica.reingresos.index')->with('error','no pudo actualizar la resolucion correctamente');
        }
        return Redirect::route('sacademica.reingresos.index')->with('info','se actualizo la resolucion correctamente');
    }
    public function update(Request $request,$id){
        try {
            //code...
            DB::beginTransaction();
            $reingreso = new Reingreso();
            $reingreso->user_id = auth()->id();
            $reingreso->fecha = Carbon::now();
            $reingreso->licencia_id = $id;
            $reingreso->observacion = $request->observacion;
            $reingreso->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('sacademica.reingresos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.reingresos.index')->with('info','se registro correctamente el reingreso');
    }
    public function destroy($id){
        try {
            //code...
            DB::beginTransaction();
            $reingreso = Reingreso::findOrFail($id);
            $reingreso->licencia->matricula->update(['licencia','SI']);
            $reingreso->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('sacademica.reingresos.index')->with('error','no se elimino el registro de reingreso correctamente');
        }
        return Redirect::route('sacademica.reingresos.index')->with('info','se elimino el registro de reingreso correctamente');
    }
}

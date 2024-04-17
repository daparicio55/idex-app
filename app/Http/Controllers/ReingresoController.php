<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Pmatricula;
use App\Models\Reingreso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            dd($th->getMessage());
            return view('sacademica.reingresos.index')->with('error',$th->getMessage());
        }
        return view('sacademica.reingresos.index')->with('info','se registro correctamente el reingreso');
    }
}

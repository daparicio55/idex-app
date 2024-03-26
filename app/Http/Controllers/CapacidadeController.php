<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapacidadeRequest;
use App\Http\Requests\CapacidadeStoreRequest;
use App\Models\Capacidade;
use App\Models\Uasignada;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;

class CapacidadeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cursos.capacidades.index')->only('index');
        $this->middleware('can:docentes.cursos.capacidades.create')->only('create','store');
        $this->middleware('can:docentes.cursos.capacidades.edit')->only('edit','update');
        $this->middleware('can:docentes.cursos.capacidades.destroy')->only('destroy');
        $this->middleware('can:docentes.cursos.capacidades.show')->only('show');
    }
    public function show($id){
        $capacidade = Capacidade::findOrFail($id);
        return view('docentes.cursos.capacidades.indicadores.index',compact('capacidade'));
    }
    public function create(Request $request){      
        $uasignada = Uasignada::findOrFail($request->asignacione);
        return view('docentes.cursos.capacidades.create',compact('uasignada'));
    }
    public function store(CapacidadeStoreRequest $request){
        try {
            //code...
            $capacidade = new Capacidade();
            $capacidade::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$request->uasignada_id)->with('info','se guardo la informacion correctamente');
    }
    public function destroy($id,CapacidadeRequest $re){
        //validar si se eliminar
        try {
            //code...
            $capacidade = Capacidade::findOrFail($id);
            $uasignada_id = $capacidade->uasignada_id;
            $capacidade->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.show',$uasignada_id)->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$uasignada_id)->with('info','se elimino la capacidad correctamente');
    }
    public function edit($id){
        $capacidade = Capacidade::findOrFail($id);
        return view('docentes.cursos.capacidades.edit',compact('capacidade'));
    }
    public function update(CapacidadeRequest $request,$id){
        //validar si se updatea o no
        try {
            //code...
            $capacidade = Capacidade::findOrFail($id);
            $uasignada = Uasignada::findOrFail($capacidade->uasignada_id);
            //return $uasignada->capacidades;
            foreach ($uasignada->capacidades as $key => $capacidadee) {
                # code...
                if ($key != 0){
                    $fecha = Carbon::parse($request->fecha);
                    $fanterior = Carbon::parse($uasignada->capacidades[$key-1]->fecha);
                    if($fecha->lessThanOrEqualTo($fanterior)){
                        throw new Exception('La fecha no puede ser igual o menor a la del anterior indicador');
                    }
                }
            }
            /* $capacidade->nombre = $request->nombre;
            $capacidade->descripcion = $request->descripcion; */
            $capacidade->fecha = $request->fecha;
            $capacidade->update();
            
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.show',$capacidade->uasignada_id)->with('info','se actualizo la fecha correctamente de la capacidad');
    }
}

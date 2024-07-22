<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use App\Models\Docentes\Recuperation;
use App\Models\EmatriculaDetalle;
use App\Models\Uasignada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecuperacioneController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $uasignada = Uasignada::findOrFail($id);
        $recuperaciones = Recuperation::whereHas('ematriculaDetalle.matricula',function($q) use($uasignada){
            $q->where('udidactica_id','=',$uasignada->udidactica_id)->where('pmatricula_id','=',$uasignada->pmatricula_id);
        })->get();
        return view('docentes.cursos.recuperaciones.index',compact('uasignada','recuperaciones'));
    }
    public function create($id){
        $uasignada = Uasignada::findOrFail($id);
        //return $uasignada;
        $emds = EmatriculaDetalle::whereHas('matricula',function($q) use($uasignada){
            $q->where('pmatricula_id','=',$uasignada->pmatricula_id);
        })
        ->where('udidactica_id','=',$uasignada->udidactica_id)
        ->whereIn('nota',[10,11,12])
        ->whereNotExists(function($q){
            $q->select('emd_id')
            ->from('recuperations')
            ->whereColumn('emd_id','ematricula_detalles.id');
        })
        ->get();
        return view('docentes.cursos.recuperaciones.create',compact('uasignada','emds'));
    }
    public function store(Request $request,$id){
        try {
            //code...
            Recuperation::create([
                'emd_id'=>$request->emd,
                'nota'=>$request->nota,
                'observacion'=>$request->observacion
            ]);
        } catch (\Throwable $th) {
            //throw $th;            
            return Redirect::route('docentes.cursos.recuperaciones.index',$id)->with('error','Error al registrar la recuperación');
        }
        return Redirect::route('docentes.cursos.recuperaciones.index',$id)->with('info','Recuperación registrada correctamente');
    }
    public function destroy($id){
        try {
            //code...
            $recuperacion = Recuperation::findOrFail($id);
            $recuperacion->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.index')->with('error','Error al eliminar la recuperación');
        }
        return Redirect::route('docentes.cursos.index')->with('info','Recuperación eliminada correctamente');
    }
}

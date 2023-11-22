<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Pmatricula;
use App\Models\Uasignada;
use App\Models\Udidactica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UasignadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.uasignadas.index')->only('index');
        $this->middleware('can:sacademica.uasignadas.create')->only('create','store');
        $this->middleware('can:sacademica.uasignadas.edit')->only('edit','update');
        $this->middleware('can:sacademica.uasignadas.destroy')->only('destroy');
        $this->middleware('can:sacademica.uasignadas.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $text = $request->searchText;
        $udidacticas = Udidactica::orderBy('nombre','asc')->get();
        $uasignadas = Uasignada::whereHas('periodo',function($query){
            $query->where('plan_cerrado','=',0);
        })->orderBy('id','desc')->paginate(5);
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        if (isset($request->buscar)){
            $uasignadas = Uasignada::orderBy('id','desc')
            ->where(function($query) use($request){
                if(isset($request->periodo)){
                    $query->where('pmatricula_id','=',$request->periodo);
                }
            })
            ->where(function($query) use($request){
                if(isset($request->udidactica)){
                    $query->where('udidactica_id','=',$request->udidactica);
                }
            })
            ->where(function($query) use($request){
                if(isset($request->docente)){
                    $query->where('user_id','=',$request->docente);
                }
            })
            ->whereHas('unidad.modulo',function($query) use($request){
                if(isset($request->carrera) and isset($request->ciclo)){
                    $query->where('carrera_id','=',$request->carrera)->where('ciclo','=',$request->ciclo);
                }else{
                    if(isset($request->carrera)){
                        $query->where('carrera_id','=',$request->carrera);
                    }else{
                        if(isset($request->ciclo)){
                            $query->where('ciclo','=',$request->ciclo);
                        }
                    }
                }
            })
            ->get();
        }
        $carreras = Carrera::orderBy('nombreCarrera')->get();
        $users = User::role('Docentes')->orderBy('name','asc')->get();
        return view('sacademica.uasignadas.index',compact('uasignadas','text','users','udidacticas','carreras','periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$users = User::orderBy('name','desc')->pluck('name','id')->toArray();
        $users = User::orderBy('name','asc')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        //devemos de obiar las unidades del plan de estudio antiguo;
        
        /* $unidades = Udidactica::orderBy('nombre','asc')->get(); */
        $unidades = Udidactica::whereHas('modulo',function($query){
            $query->where('iformativo_id','=',5);
        })->orderBy('nombre','desc')->get();
        //dd($unidades);
        return view('sacademica.uasignadas.create',compact('users','unidades','periodos'));
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
        try {
            //code...
            $unidades = $request->udidactica;
            for($i=0; $i<count($unidades);$i++){
                $asignada = new Uasignada();
                $asignada->user_id = $request->user_id;
                $asignada->pmatricula_id = $request->pmatricula_id;
                $asignada->udidactica_id = $unidades[$i];
                $asignada->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.uasignadas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','se guardo las asignaciones correctamente');
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
        $request->validate([
            'user'=>'required'
        ]);
        try {
            //code...
            $uasignada = Uasignada::findOrFail($id);
            $user = User::findOrFail($request->user);
            $uasignada->user_id = $user->id;
            $uasignada->update();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','se actualizo correctamente al docente');
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
            $uasignada = Uasignada::findOrFail($id);
            $uasignada->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.uasignadas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','se elimino el registro correctamente');
    }
}

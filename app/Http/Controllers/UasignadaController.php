<?php

namespace App\Http\Controllers;

use App\Models\Capacidade;
use App\Models\Carrera;
use App\Models\Indicadore;
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
            /* $query->where('iformativo_id','=',5); */
        })->orderBy('nombre','desc')->get();
       
        //dd($unidades);
        return view('sacademica.uasignadas.create',compact('users','unidades','periodos'));
    }
    public function getunidades($pmatricula_id){
        $periodo = Pmatricula::findOrFail($pmatricula_id);
        $numero = explode("-",$periodo->nombre);
        if($numero[1]==1){
            $arr=["I","III","V"];
        }else{
            $arr=["II","IV","VI"];
        }
        $unidades = Udidactica::whereDoesntHave('uasignadas',function($query) use($pmatricula_id) {
            $query->where('pmatricula_id','=',$pmatricula_id);
        })->get();

        $array = [];
        foreach ($unidades as $key => $unidad) {
            # code...
            if($unidad->modulo->iformativo_id == 4){
                if(in_array($unidad->ciclo,$arr)){
                    $a = [
                        'id' => $unidad->id,
                        'nombre' => $unidad->nombre.' - '.$unidad->modulo->carrera->nombreCarrera.' - '.$unidad->ciclo.' - '.$unidad->horas.' - '.$unidad->creditos
                    ];
                    array_push($array,$a);
                }
            }
        }

        return $array;
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
            $udidactica = Udidactica::findOrFail($request->udidactica[0]);
            for($i=0; $i<count($unidades);$i++){
                $asignada = new Uasignada();
                $asignada->user_id = $request->user_id;
                $asignada->pmatricula_id = $request->pmatricula_id;
                $asignada->udidactica_id = $unidades[$i];
                $asignada->save();

                //creamo la capacidades
                foreach ($udidactica->capabilities as $capabilitie) {
                    # code...
                    $capacidade = new Capacidade();
                    $capacidade->nombre = $capabilitie->nombre;
                    $capacidade->descripcion = $capabilitie->descripcion;
                    $capacidade->uasignada_id = $asignada->id;
                    $capacidade->save();
                    //ponemos los indicadores
                    foreach ($capabilitie->indicators as $indicator) {
                        # code...
                        $indicador = new Indicadore();
                        $indicador->nombre = $indicator->nombre;
                        $indicador->descripcion = $indicator->descripcion;
                        //$indicador->fecha
                        $indicador->capacidade_id = $capacidade->id;
                        $indicador->save();
                    }
                }
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

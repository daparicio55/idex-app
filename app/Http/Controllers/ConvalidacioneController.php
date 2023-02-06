<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ConvalidacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $buscar;
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:sacademica.convalidaciones.index')->only('index');
        $this->middleware('can:sacademica.convalidaciones.create')->only('create','store');
        $this->middleware('can:sacademica.convalidaciones.edit')->only('edit','update');
        $this->middleware('can:sacademica.convalidaciones.destroy')->only('destroy');
        $this->middleware('can:sacademica.convalidaciones.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        if(isset($request->search)){
            /* $clientes = Cliente::whereHas('postulaciones.estudiante.matriculas.detalles',function($query){
                $query->where('tipo','Convalidacion');
            })
            ->where('dniRuc','72781607')
            ->orWhere('apellido','like','%'.$request->search.'%')
            ->get(); */
            $search = $request->search;
            $this->buscar = $request->search;
            $convalidaciones = Ematricula::WhereRelation('detalles','tipo','Convalidacion')
            ->whereHas('estudiante.postulante.cliente',function($query){
                $query->where('dniRuc',$this->buscar)
                ->orWhere('apellido','like','%'.$this->buscar.'%')
                ->orWhere('nombre','like','%'.$this->buscar.'%');
            })->get();
            return view('sacademica.convalidaciones.index',compact('convalidaciones','search'));
        }
        $convalidaciones = Ematricula::WhereRelation('detalles','tipo','Convalidacion')
        ->paginate(5);
        return view('sacademica.convalidaciones.index',compact('convalidaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            //code...
            $tipo = ['Convalidacion'=>'Convalidacion'];
            $searchText=null;
            $estudiante=null;
            $unidades=null;
            $periodos = Pmatricula::orderBy('nombre','desc')->pluck('nombre','id')->toArray();
            if(isset($request->searchText)){
            $dni = $request->searchText;
            $searchText=$dni;
            //tengo q buscar por el dni
            //primero buscamos en la tabla de estudiantes
            //en algun momento tendremos hasta mas de 2 resultados;
            $cliente = Cliente::where('dniRuc','=',$dni)->first();
            $estudiante = Estudiante::whereRelation('postulante','idCliente',$cliente->idCliente)->first();
            //buscar unidades didacticas
            $unidades = Udidactica::whereRelation('modulo','carrera_id',$estudiante->postulante->carrera->idCarrera)
            ->get();
        }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/convalidaciones')->with('error',$th->getMessage());
        }
        return view('sacademica.convalidaciones.create',compact('periodos','tipo','searchText','estudiante','unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            DB::beginTransaction();
            $ematricula_id = DB::table('ematriculas')
            ->where('estudiante_id','=',$request->estudiante_id)
            ->where('pmatricula_id','=',$request->pmatricula_id)
            ->first()->id;
            //ahora tenemos que ingresar las convalidaciones.
            $filas = count($request->notas);
            for ($i=0; $i < $filas ; $i++) { 
            # code...
            //matricula detalle
            $detalle = new EmatriculaDetalle;
            $detalle->tipo = "Convalidacion";
            $detalle->udidactica_id = $request->idUniDidactica[$i];
            $detalle->ematricula_id = $ematricula_id;
            $detalle->nota = $request->notas[$i];
            $detalle->observacion = $request->resolucion;
            $detalle->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/convalidaciones')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/convalidaciones')->with('info','se ingreso la convalidacion correctamente');
        //tengo q buscar la matricula para hacer su convalidacion
        
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
    public function destroy($id, Request $request)
    {
        //
        try {
            //code...
            $convalidacion = Ematricula::findOrfail($id);
            foreach ($convalidacion->detalles as $detalle){
                if($request->origen == 'convalidaciones'){
                    if ($detalle->tipo == "Convalidacion"){
                        $detalle = EmatriculaDetalle::findOrFail($detalle->id);
                        $detalle->delete();
                    }
                }
                if($request->origen == 'regularizaciones'){
                    if ($detalle->tipo == "Regularizacion" || $detalle->tipo == "Extraordinario"){
                        $detalle = EmatriculaDetalle::findOrFail($detalle->id);
                        $detalle->delete();
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.'.$request->origen.'.index')
            ->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.'.$request->origen.'.index')
        ->with('info','se borro la informacion');
    }
}

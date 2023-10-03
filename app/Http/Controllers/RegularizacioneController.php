<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegularizacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $buscar;
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:sacademica.regularizaciones.index')->only('index');
        $this->middleware('can:sacademica.regularizaciones.create')->only('create','store');
        $this->middleware('can:sacademica.regularizaciones.edit')->only('edit','update');
        $this->middleware('can:sacademica.regularizaciones.destroy')->only('destroy');
        $this->middleware('can:sacademica.regularizaciones.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        if(isset($request->search)){
            
            $search = $request->search;
            $this->buscar = $request->search;
            $regularizaciones = Ematricula::whereHas('detalles',function($consulta){
                $consulta->where('tipo','Regularizacion')->orWhere('tipo','Extraordinario');
            })
            ->whereHas('estudiante.postulante.cliente',function($query){
                $query->where('dniRuc',$this->buscar)
                ->orWhere('nombre','like','%'.$this->buscar.'%')
                ->orWhere('apellido','like','%'.$this->buscar.'%');
            })->get();
            return view('sacademica.regularizaciones.index',compact('regularizaciones','search'));
        }
        $regularizaciones = Ematricula::WhereRelation('detalles','tipo','Regularizacion')
        ->orWhereRelation('detalles','tipo','Extraordinario')
        ->paginate(5);
        return view('sacademica.regularizaciones.index',compact('regularizaciones'));

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
            $tipo = ['Regularizacion'=>'Regularizacion','Extraordinario'=>'Extraordinario'];
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
            return Redirect::to('sacademica/regularizaciones')->with('error',$th->getMessage());
        }
        return view('sacademica.regularizaciones.create',compact('periodos','tipo','searchText','estudiante','unidades'));
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
        /* "_token" => "8qZAoEnBtg2f0yZG0M0hUANDvpFViorqJcS4im6e"
        "estudiante_id" => "893"
        "telefono" => "910858734"
        "telefono2" => "910858734"
        "email" => "76135545@idexperujapon.edu.pe"
        "direccion" => "San carlos de Murcia"
        "pmatricula_id" => "91"
        "tipo" => "Regularizacion"
        "fecha" => "2023-10-03"
        "resolucion" => "-"
        "estado" => array:1
        "notas" => array:1
        "unidades" => array: 1 */
        
        try {
            //code...
            DB::beginTransaction();
            $ematricula_id = DB::table('ematriculas')
            ->where('estudiante_id','=',$request->estudiante_id)
            ->where('pmatricula_id','=',$request->pmatricula_id)
            ->first();
            if(!isset($ematricula_id->id)){
                $ematricula_id = new Ematricula;
                $ematricula_id->tipo = "Extra";
                $ematricula_id->fecha = Carbon::now();
                $ematricula_id->boleta = "000";
                $ematricula_id->pmatricula_id = $request->pmatricula_id;
                $ematricula_id->estudiante_id = $request->estudiante_id;
                $ematricula_id->user_id = auth()->id();
                $ematricula_id->save();
            }
            //ahora tenemos que ingresar las convalidaciones.
            $filas = count($request->notas);
            for ($i=0; $i < $filas ; $i++) { 
            //matricula detalle
            if($request->estado[$i] == "SI"){
                $detalle = new EmatriculaDetalle;
                $detalle->tipo = $request->tipo;
                $detalle->udidactica_id = $request->unidades[$i];
                $detalle->ematricula_id = $ematricula_id->id;
                $detalle->nota = $request->notas[$i];
                $detalle->observacion = $request->resolucion;
                $detalle->save();
            }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/regularizaciones/')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/regularizaciones')->with('info','se ingreso la convalidacion correctamente');
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
    public function destroy($id)
    {
        //
    }
}

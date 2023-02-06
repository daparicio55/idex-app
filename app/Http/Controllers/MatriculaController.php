<?php

namespace App\Http\Controllers;

use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\Estudiante;
use App\Models\Cliente;
use App\Models\EmatriculaDetalle;
use App\Models\Pmatricula;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $buscar;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.matriculas.index')->only('index');
        $this->middleware('can:sacademica.matriculas.create')->only('create','store');
        $this->middleware('can:sacademica.matriculas.edit')->only('edit','update');
        $this->middleware('can:sacademica.matriculas.destroy')->only('destroy');
        $this->middleware('can:sacademica.matriculas.show')->only('show');
    }
    public function index(Request $request)
    {
        //vamos a sacar el periodo actual
        $anio = Carbon::now()->parse()->year;
        $periodoPar = Pmatricula::where('nombre','=',$anio."-1")->first();
        $periodoImpar = Pmatricula::where('nombre','=',$anio."-2")->first();
        $searchText = null;
        if (isset($request->searchText)){
            $this->buscar = $request->searchText;
            $searchText = $request->searchText;
            /* $matriculas = Ematricula::orderBy('id','desc')
            ->get(); */
            $matriculas = Ematricula::orderBy('id','desc')
            ->whereHas('estudiante.postulante.cliente',function($query){
                $query->where('dniRuc',$this->buscar)
                ->orWhere('apellido','like','%'.$this->buscar.'%')
                ->orWhere('nombre','like','%'.$this->buscar.'%');
            })->get();
        }else{
            $matriculas = Ematricula::orderBy('id','desc')->paginate(50);
        }
        return view('sacademica.ematriculas.index',compact('matriculas','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sexos = ['Masculino'=>'Masculino','Femenino'=>'Femenino'];
        $periodos = Pmatricula::orderBy('nombre','desc')
        ->pluck('nombre','id')
        ->toArray();
        $tipo = tMatricula();
        return view('sacademica.ematriculas.create',compact('sexos','periodos','tipo'));
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
            DB::beginTransaction();
            //actualizar clientes
            $contador = count($request->unidades);
            $estudiante = Estudiante::findOrFail($request->estudiante_id);
            $cliente = Cliente::findOrFail($estudiante->postulante->cliente->idCliente);
            $cliente->telefono = $request->telefono;
            $cliente->telefono2 = $request->telefono2;
            $cliente->direccion = $request->direccion;
            $cliente->email = $request->email;
            $cliente->save();
            //actualizamos postulante
            $postulante = AdmisionePostulante::findOrFail($estudiante->postulante->id);
            $postulante->fechaNacimiento = $request->fechaNacimiento;
            $postulante->sexo = $request->sexo;
            $postulante->save();
            //guardamos la matricula
            $matricula = new Ematricula;
            $matricula->tipo = $request->tipo;
            $matricula->pmatricula_id = $request->pmatricula_id;
            $matricula->fecha = $request->fecha;
            $matricula->estudiante_id = $request->estudiante_id;
            $matricula->user_id = auth()->id();
            $matricula->save();
            //ingresamos los detalles
            for ($i=0; $i < $contador ; $i++) { 
                # code...
                if ($request->unidades[$i] == "SI"){
                    $detalle = new EmatriculaDetalle;
                    $detalle->udidactica_id = $request->unidadesid[$i];
                    $detalle->ematricula_id = $matricula->id;
                    if(isset($request->notas[$i])){
                        $detalle->tipo = "Repitencia";
                    }else{
                        $detalle->tipo = "Regular";
                    }
                    $detalle->save();
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/matriculas')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/matriculas')->with('info','se registro correctamente');
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
        $matricula = Ematricula::findOrFail($id);
        return view('sacademica.ematriculas.show',compact('matricula'));
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
        try {
            //code...
            $matricula = Ematricula::findOrFail($id);
            $matricula->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/matriculas')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/matriculas')->with('info','se elimino correctamente');
    }
}

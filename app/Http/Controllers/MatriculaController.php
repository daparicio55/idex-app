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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.matriculas.index')->only('index');
        $this->middleware('can:sacademica.matriculas.create')->only('create','store');
        $this->middleware('can:sacademica.matriculas.edit')->only('edit','update');
        $this->middleware('can:sacademica.matriculas.destroy')->only('destroy');
        $this->middleware('can:sacademica.matriculas.show')->only('show');
    }
    public function indexRequestValidate($request){
        $programa = $request->programa;
        $ciclo = $request->ciclo;
        $periodo = $request->periodo;
        $searchText = $request->searchText;
        if(isset($programa) || isset($ciclo) || isset($periodo) || isset($searchText)){
            return true;
        }else{
            return false;
        }
    }
    public function index(Request $request)
    {
        $programas = Carrera::orderBy('nombreCarrera')->where('observacionCarrera','=','visible')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
       /*  $anio = Carbon::now()->parse()->year;
        $periodoPar = Pmatricula::where('nombre','=',$anio."-1")->first();
        $periodoImpar = Pmatricula::where('nombre','=',$anio."-2")->first(); */
        if($this->indexRequestValidate($request)){
            $matriculas = Ematricula::when($request->searchText,function($queryText) use($request){
                $queryText->whereHas('estudiante.postulante.cliente',function($query) use($request){
                    $query->where('dniRuc','=',$request->searchText)
                    ->orWhere('nombre','like','%'.$request->searchText.'%')
                    ->orWhere('apellido','like','%'.$request->searchText.'%');
                });
            })->when($request->programa,function($queryPrograma) use($request){
                $queryPrograma->whereHas('estudiante.postulante',function($query) use($request){
                    $query->where('idCarrera','=',$request->programa);
                });
            })->when($request->ciclo,function($queryCiclo) use($request){
                $queryCiclo->whereHas('detalles.unidad',function($query) use($request){
                    $query->where('ciclo','=',$request->ciclo);
                });
            })->when($request->periodo,function($queryPeriodo) use($request){
                $queryPeriodo->where('pmatricula_id','=',$request->periodo);
            })
            ->get();
        }else{
            $matriculas = Ematricula::whereHas('matricula',function($query){
                $query->where('plan_cerrado',0);
            })->orderBy('id','desc')
            ->paginate(10);
        }
        return view('sacademica.ematriculas.index',compact('matriculas','programas','periodos'));
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
        ->where('plan_cerrado',0)
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
        return view('sacademica.ematriculas.showv2',compact('matricula'));
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

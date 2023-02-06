<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VerificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.verificaciones.index')->only('index');
        $this->middleware('can:sacademica.verificaciones.create')->only('create','store');
        $this->middleware('can:sacademica.verificaciones.edit')->only('edit','update');
        $this->middleware('can:sacademica.verificaciones.destroy')->only('destroy');
        $this->middleware('can:sacademica.verificaciones.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        
        $programas = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $matriculas = Pmatricula::orderBy('nombre','desc')
        ->pluck('nombre','id')->toArray();
        $tipos = [
            'Unido'=>'Unido',
            'Separado'=>'Separado'
        ];
        $periodos = Admisione::orderBy('periodo','desc')->pluck('periodo','id')->toArray();
        if(isset($request->idCarrera)){
            $carrera = $request->idCarrera;
            $carr = Carrera::findOrFail($carrera);
            $matricula = $request->pmatricula_id;
            $periodo = Pmatricula::findOrFail($matricula);
            $ciclo = $request->ciclo;
            $tipo = $request->tipo;

            if($tipo == 'Unido'){
                $modulos = Udidactica::where('ciclo','=',$ciclo)
                ->whereRelation('modulo','carrera_id','=',$carrera)
                ->orderBy('nombre','asc')
                ->get();

                /* $modulos = DB::table('udidacticas as udi')
                ->select('udi.nombre','udi.id')
                ->join('mformativos as mfor','mfor.id','=','udi.mformativo_id')
                ->where('mfor.carrera_id','=',$carrera)
                ->where('udi.ciclo','=',$ciclo)
                ->get(); */

                $matriculas = Ematricula::where('pmatricula_id','=',$matricula)
                ->get();
                
                $estudiantes = DB::table('ematriculas as ema')
                ->select('ema.licencia','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.sexo','pos.discapacidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                ->where('ud.ciclo','=',$ciclo)
                ->where('mf.carrera_id','=',$carrera)
                ->groupBy('ema.licencia','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.sexo','pos.discapacidad')
                ->orderBy('cli.apellido','asc')
                ->orderBy('cli.nombre','asc')
                ->get();
                return view('sacademica.verificaciones.completo',compact('carr','ciclo','estudiantes','modulos','periodo'));
            }else{
                //aca vamos separado
                $modulos = Udidactica::where('ciclo','=',$ciclo)
                ->whereRelation('modulo','carrera_id','=',$carrera)
                ->orderBy('nombre','asc')
                ->get();
                //lista de alumnos
                $estudiantes = DB::table('ematriculas as ema')
                ->select('ema.licenciaObservacion','ema.licencia','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.sexo','pos.discapacidad','ud.nombre as unidad')
                ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
                ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
                ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
                ->join('estudiantes as es','es.id','=','ema.estudiante_id')
                ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
                ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
                ->where('ema.pmatricula_id','=',$matricula)
                ->where('ud.ciclo','=',$ciclo)
                ->where('mf.carrera_id','=',$carrera)
                ->groupBy('ema.licenciaObservacion','ema.licencia','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.sexo','pos.discapacidad','ud.nombre')
                ->orderBy('unidad','asc')
                ->orderBy('cli.apellido','asc')
                ->orderBy('cli.nombre','asc')
                ->get();
                return view('sacademica.verificaciones.separado',compact('estudiantes','modulos','carr','periodo','ciclo'));
            }
        }
        return view('sacademica.verificaciones.index',compact('programas','matriculas','tipos','periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        /* $estudiantes = Estudiante::whereRelation('Postulante','idCarrera',$request->idCarrera)
        ->whereRelation('Postulante','admisione_id',$request->admisione_id)
        ->get(); */

        $estudiantes = DB::table('admisione_postulantes as ap')
        ->select('es.id','car.nombreCarrera','cli.nombre','cli.apellido','cli.dniRuc','ap.fechaNacimiento')
        ->join('ccarreras as car','car.idCarrera','=','ap.idCarrera')
        ->join('clientes as cli','cli.idCliente','=','ap.idCliente')
        ->join('estudiantes as es','ap.id','=','es.admisione_postulante_id')
        ->where('ap.admisione_id','=',$request->admisione_id)
        ->where('ap.idCarrera','=',$request->idCarrera)
        ->orderBy('cli.apellido','asc')
        ->orderBy('cli.nombre','asc')
        ->get();

        $unidades = DB::table('udidacticas as ud')
        ->select('ud.id','mf.nombre as modulo','ud.ciclo','ud.tipo','ud.nombre','ud.creditos')
        ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
        ->join('ccarreras as ca','mf.carrera_id','=','ca.idCarrera')
        ->where('ca.idCarrera','=',$request->idCarrera)
        ->orderBy('ud.ciclo','asc')
        ->orderBy('mf.nombre','asc')
        ->orderBy('ud.tipo','desc')
        ->orderBy('ud.nombre','asc')
        ->get();
        return view('sacademica.verificaciones.imprimir',compact('estudiantes','unidades'));
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
        //dd($request);
        try {
            //code....
            DB::beginTransaction();
            $cantidad = count($request->id)-1;
            if(isset($request->es_id)){
                $cant = count($request->es_id)-1;
                for($z=0;$z<$cant;$z++){
                    $matricula = Ematricula::findOrFail($request->es_id[$z]);
                    $matricula->ponderado = $request->ponderados[$z];
                    $matricula->puesto = $request->puestos[$z];
                    $matricula->update();
                }
            }
            for($i=0;$i<=$cantidad;$i++){
                $detalle = EmatriculaDetalle::findOrFail($request->id[$i]);
                $detalle->nota = $request->notas[$i];
                $detalle->update();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/verificaciones')->with('error',$th->__toString());
        }
        return Redirect::to('sacademica/verificaciones')->with('info','la informacion con las notas se guardaron correctamente');
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

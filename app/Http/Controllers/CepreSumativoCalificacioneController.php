<?php

namespace App\Http\Controllers;

use App\Exports\CepreEstudianteExport;
use App\Models\Cepre;
use App\Models\CepreEstudiante;
use App\Models\CepreSumativo;
use App\Models\CepreSumativoAlternativa;
use App\Models\CepreSumativoMarcada;
use App\Models\CepreSumativoResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class CepreSumativoCalificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.sumativos.calificaciones.index')->only('index');
        $this->middleware('can:cepres.sumativos.calificaciones.create')->only('create','store');
        $this->middleware('can:cepres.sumativos.calificaciones.edit')->only('edit','update');
        $this->middleware('can:cepres.sumativos.calificaciones.destroy')->only('destroy');
        $this->middleware('can:cepres.sumativos.calificaciones.show')->only('show');
        $this->middleware('can:cepres.sumativos.calificaciones.normalizar')->only('normalizar');
        $this->middleware('can:cepres.sumativos.calificaciones.subircsv')->only('subircsv');
        $this->middleware('can:cepres.sumativos.calificaciones.resultados')->only('resultados');
    }
    public function index(Request $request)
    {
        //
        $sumativos = CepreSumativo::orderBy('id','desc')->pluck('nombre','id')->toArray();
        if(isset($request->id)){
            $sumativo = CepreSumativo::findOrFail($request->id);
            $estudiantes = CepreEstudiante::orderBy('idCepreEstudiante','desc')
            ->where('idCepre','=',$sumativo->cepre_id)
            ->get();
            return view('cepres.sumativos.calificaciones.index',compact('sumativo','sumativos','estudiantes'));
        }
        return view('cepres.sumativos.calificaciones.index',compact('sumativos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        try {
            //code...
            DB::beginTransaction();
            $estudiante = CepreEstudiante::findOrFail($id);
            if($estudiante->sumatorio == 'SI'){
                $estudiante->sumatorio = 'NO';
            }else{
                $estudiante->sumatorio = 'SI';
            }
            DB::commit();
        $estudiante->update();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('cepres/sumativos/calificaciones')->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/calificaciones')->with('info','se actualizo el estato correctamente');
    }
    public function normalizar($id){
        //vamos a buscar a todos los alumnos de esa cepre
            try {
                //code...
                DB::beginTransaction();
                $sumativo = CepreSumativo::findOrFail($id);
                $estudiantes = CepreEstudiante::where('idCepre','=',$sumativo->cepre_id)->get();
                foreach ($estudiantes as $estudiante) {
                # code...
                if(ceprePorPagar($estudiante->idCepreEstudiante) == 0){
                    $estu = CepreEstudiante::findOrFail($estudiante->idCepreEstudiante);
                    $estu->sumatorio = "SI";
                    $estu->update();
                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('cepres/sumativos/calificaciones?id='.$id)->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/calificaciones?id='.$id)->with('info','se normalizaron todos los registros');
    }
    public function subircsv(Request $request,$id){
        //se sube la informacion del CSV para su prosesamiento en la base de datos.}
        //utf8_encode($datos[0]);
        try {
            //code...
            set_time_limit(0);
            DB::beginTransaction();
            $sumativo = CepreSumativo::findOrFail($id);
            CepreSumativoMarcada::where('cepre_sumativo_id','=',$id)->delete();
            CepreSumativoResultado::where('cepre_sumativo_id','=',$id)->delete();
            $preguntas = $sumativo->preguntas;
            if($request->hasFile('csv')){
                $file = $request->file('csv');
                $f = fopen($file, 'r');
                $linea = 0;
                while (($datos = fgetcsv($f,0,';')) !== false){
                    //ingresamos una nueva linea
                    if($linea != 0){
                        for ($i=1; $i <=$preguntas ; $i++) { 
                            //ingresamos la primera
                            $respuesta = new CepreSumativoMarcada;
                            $respuesta->dni = $datos[0];
                            $respuesta->pregunta = $i;
                            $respuesta->marcada = $datos[$i];
                            $respuesta->cepre_sumativo_id = $id;
                            $respuesta->save();
                        }
                    }
                    $linea ++;
                }   
                fclose($f);
            }
            
            //ahora vamos a verificar los resultados
            $estudiantes = CepreEstudiante::where('idCepre','=',$sumativo->cepre->idCepre)
            ->where('sumatorio','=','SI')
            ->get();
            
            //ahora voy a recorrer cada uno para ponerles sus notas y puntajes;
            foreach($estudiantes as $estudiante){
                $calificacion = sumativoPuntaje($estudiante->cliente->dniRuc,$id);
                $resultado = new CepreSumativoResultado;
                $resultado->dni = $estudiante->cliente->dniRuc;
                $resultado->apellido = $estudiante->cliente->apellido;
                $resultado->nombre = $estudiante->cliente->nombre;
                $resultado->carrera = $estudiante->carrera->nombreCarrera;
                $resultado->correctas = $calificacion->correctas;
                $resultado->incorrectas = $calificacion->incorrectas;
                $resultado->blancas = $calificacion->blancas;
                $resultado->puntaje = $calificacion->puntaje;
                $resultado->cepre_sumativo_id = $id;
                $resultado->save();
            }
            //puntajes listos

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('cepres/sumativos/calificaciones?id='.$id)->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/calificaciones?id='.$id)->with('info','se subieron todos los datos correctamente todos los registros');
    }
    public function resultados($id){
        $sumativo = CepreSumativo::findOrFail($id);
        $resultados = CepreSumativoResultado::orderBy('carrera','asc')
        ->orderBy('puntaje','desc')
        ->where('cepre_sumativo_id','=',$id)
        ->get();
        return view ('cepres.sumativos.calificaciones.resultados',compact('resultados','sumativo'));
    }
    public function descargar($id){
        $cepre = Cepre::findOrFail($id);
        return Excel::download(new CepreEstudianteExport($id), $cepre->periodoCepre.'.xlsx');
    }
}

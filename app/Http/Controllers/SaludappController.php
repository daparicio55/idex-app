<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Sddo;
use App\Models\Sdo;
use App\Models\Sqalternative;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaludappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('salud.app.index');
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
        $validate = $request->validate([
            'dni'=>'required',
            'fecha'=>'required'
        ]);
        if($request->contrato == 1){
            $est = Estudiante::findOrFail($request->estudiante_id);
            $est->contrato = 1;
            $est->update();
        }
     //ahora verificamos si la fecha de nacimiento coincide con lo informado.
        $cliente = Cliente::where('dniRuc','=',$request->dni)->first();
        $dni = $request->dni;
        $fecha = $request->fecha;
        $cantidad = Cliente::whereHas('postulaciones',function($query) use ($dni,$fecha){
            $query->where('dniRuc','=',$dni)->where('fechaNacimiento','=',$fecha);
        })->count();

        $cliente = Cliente::whereHas('postulaciones',function($query) use ($dni,$fecha){
            $query->where('dniRuc','=',$dni)->where('fechaNacimiento','=',$fecha);
        })->first();
        if ($cantidad == 0){      
            return Redirect::route('salud.app.index')->with('error','los datos son incorrectos');
        }
        $estudiante = Estudiante::whereHas('postulante.cliente',function($query) use($dni){
            $query->where('dniRuc','=',$dni);
        })->first();
        //verificamos si acepto los terminos del uso de la aplicacion.
        if($estudiante->contrato == 0){
            //redirigirlo para que firme el contrato
            return view('salud.app.contrato',compact('estudiante','cliente'));
        }


        return view('salud.app.show',compact('cliente','estudiante'));
        //return Redirect::route('salud.app.show',['app'=>$cliente->idCliente]);
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
        dd($id);
        
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
    public function profile($id){
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.profile',compact('estudiante'));
    }
    public function atencione($id){
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.atencione',compact('estudiante'));
    }
    public function resultados($id){
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.resultados',compact('estudiante'));
    }
    public function encuestas($id){
        $surveys = Survey::orderBy('id','desc')
        ->where('type','=','Encuestas')
        ->get();
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.encuestas',compact('estudiante','surveys'));
    }
    public function psicologia($id){
        $surveys = Survey::orderBy('id','desc')
        ->where('type','=','Psicologia')
        ->get();
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.psicologia',compact('estudiante','surveys'));
    }
    public function surveys($id){
        $dato = explode(':',$id);
        $estudiante = Estudiante::findOrFail($dato[1]);
        $survey = Survey::findOrFail($dato[0]);
        return view('salud.app.surveys',compact('estudiante','survey'));
    }
    public function surveys_store(Request $request){
        //dd($request);
        try {
            //cremos que se lleno la encuesta
            DB::beginTransaction();
            //buscamos la encuesta
            $sdoCount = Sdo::where('estudiante_id','=',$request->estudiante_id)
            ->where('survey_id','=',$request->survey_id)
            ->count();
                if ($sdoCount > 0){
                    //ya esta la encuesta
                    $estudiante = Estudiante::findOrFail($request->estudiante_id);
                    $encuesta = Sdo::where('estudiante_id','=',$request->estudiante_id)
                    ->where('survey_id','=',$request->survey_id)
                    ->first();
                    $sdo = Sdo::findOrFail($encuesta->id);
                    $sdo->date = Carbon::now();
                    $sdo->update();
                    //borramos todos los detalles

                    Sddo::where('sdo_id','=',$sdo->id)->delete();
                    $survey = Survey::findOrFail($request->survey_id);
                    foreach ($survey->questions as $question) {
                        # code...
                        $sddo = new Sddo();
                        $sddo->sqalternative_id = $request->get('rd-'.$question->id);
                        //verificamos si tiene la columna required para agregar la observacion
                        $alternavite = Sqalternative::findOrFail($sddo->sqalternative_id);
                        if ($alternavite->required == 1){
                            //dd($request->get('txt-'.$sddo->sqalternative_id));
                            $sddo->observation = $request->get('txt-'.$sddo->sqalternative_id);
                        }
                        $sddo->sdo_id = $sdo->id;
                        $sddo->save();
                    }


                }else{
                    $estudiante = Estudiante::findOrFail($request->estudiante_id);
                    $survey = Survey::findOrFail($request->survey_id);
                    $sdo = new Sdo();
                    $sdo->survey_id = $request->survey_id;
                    $sdo->estudiante_id = $request->estudiante_id;
                    $sdo->date = Carbon::now();
                    $sdo->save();
                    //ahora guardamos los detalles del ingreso
                    //buscamos las preguntas
                    foreach ($survey->questions as $question) {
                        # code...
                        $sddo = new Sddo();
                        $sddo->sqalternative_id = $request->get('rd-'.$question->id);
                        //verificamos si tiene la columna required para agregar la observacion
                        $alternavite = Sqalternative::findOrFail($sddo->sqalternative_id);
                        if ($alternavite->required == 1){
                            //dd($request->get('txt-'.$sddo->sqalternative_id));
                            $sddo->observation = $request->get('txt-'.$sddo->sqalternative_id);
                        }
                        $sddo->sdo_id = $sdo->id;
                        $sddo->save();
                    }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            DB::rollBack();
            return Redirect::route('salud.app.encuestas',[$estudiante->id])
            ->with('error','error en la consulta');
        }
        return Redirect::route('salud.app.encuestas',[$estudiante->id])
        ->with('info','encuesta guardada correctamente');
    }
    
}

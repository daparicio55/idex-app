<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Sddo;
use App\Models\Sdo;
use App\Models\Sqalternative;
use App\Models\Survey;
use Carbon\Carbon;
use DragonCode\Contracts\Cashier\Auth\Auth;
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
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function profile(){
        return view('salud.app.profile');
    }
    public function atencione(){
        return view('salud.app.atencione');
    }
    public function resultados(){
        return view('salud.app.resultados');
    }
    public function encuestas(){
        $surveys = Survey::orderBy('id','desc')
        ->where('type','=','Encuestas')
        ->get();
        return view('salud.app.encuestas',compact('surveys'));
    }
    public function psicologia($id){
        $surveys = Survey::orderBy('id','desc')
        ->where('type','=','Psicologia')
        ->get();
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.psicologia',compact('estudiante','surveys'));
    }
    public function surveys($id){
        $survey = Survey::findOrFail($id);
        return view('salud.app.surveys',compact('survey'));
    }
    public function surveys_store(Request $request){
        if(auth()->user()->hasRole('Bolsa User')){
            $estudiante_id = auth()->user()->ucliente->cliente->postulaciones[0]->estudiante->id;
        }else{
            return Redirect::route('salud.app.encuestas')->with('info','no tiene permisos para realizar esta accion');
        };
        //
        try {
            //cremos que se lleno la encuesta
            DB::beginTransaction();
            //buscamos la encuesta
            
            $sdoCount = Sdo::where('estudiante_id','=',$estudiante_id)
            ->where('survey_id','=',$request->survey_id)
            ->count();
                if ($sdoCount > 0){
                    //ya esta la encuesta
                    $estudiante = Estudiante::findOrFail($estudiante_id);
                    $encuesta = Sdo::where('estudiante_id','=',$estudiante)
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
                    $estudiante = Estudiante::findOrFail($estudiante_id);
                    $survey = Survey::findOrFail($request->survey_id);
                    $sdo = new Sdo();
                    $sdo->survey_id = $request->survey_id;
                    $sdo->estudiante_id = $estudiante->id;
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
            return Redirect::route('salud.app.encuestas')
            ->with('error','error en la consulta');
        }
        return Redirect::route('salud.app.encuestas')
        ->with('info','encuesta guardada correctamente');
    }
    public function herramientas(){
        return view('salud.app.herramientas');
    }
}

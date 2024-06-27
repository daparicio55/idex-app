<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Sddo;
use App\Models\Sdo;
use App\Models\Sqalternative;
use App\Models\Survey;
use App\Models\Uasignada;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

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
    protected $mapeoTildes = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
        'ü' => 'u', 'Ü' => 'U', 'ñ' => 'n', 'Ñ' => 'N'
    ];
    protected function fdias($asignacione){
        //llenamos con los días de la semana que se lleva esta unidad didactica
        $dias = [];
        foreach ($asignacione->horarios as $key => $horario) {
            # code...
            $dias [] = strtolower($horario->day);
        }
        //determinamos el dia de inicio y el dia de fin;
        $fechaInicio = Carbon::parse($asignacione->periodo->finicio);
        $fechaFin = Carbon::parse($asignacione->periodo->ffin);
        //llenamos un array con las fechas que hay entre el periodo de inicio y fin
        $fechasEntre = [];
        $semanasEntre = [];
        // Añadimos la fecha de inicio al array
        $fechasEntre[] = $fechaInicio->toDateString();
        // Iteramos sobre las fechas desde la fecha de inicio hasta la fecha de fin
        while ($fechaInicio->addDay() <= $fechaFin) {
            // Añadimos cada fecha al array
            $fechasEntre[] = $fechaInicio->toDateString();
        }
        //semanas entre
        $finsemanaInicio = Carbon::parse($asignacione->periodo->finicio)->endOfWeek(Carbon::SUNDAY);
        $finsemanaFin = Carbon::parse($asignacione->periodo->ffin)->endOfWeek(Carbon::SUNDAY);
        $semanasEntre[] = $finsemanaInicio->toDateString();
        //dd($finsemanaInicio->toDateString());
        while ($finsemanaInicio->addWeek() <= $finsemanaFin) {
            // Añadimos cada fecha al array
            $semanasEntre[] = $finsemanaInicio->toDateString();
        }
        
        //dd($semanasEntre);
        //array con las fechas que coincidan con los dias que toca la unidad didactica
        $fdias = [];
        for ($i=0; $i < count($fechasEntre); $i++) { 
            # code...
            $fecha = Carbon::parse($fechasEntre[$i]);
            $diaDeLaSemana = $fecha->isoFormat('E');
            $nombreDia =  strtr($fecha->isoFormat('dddd'), $this->mapeoTildes);
            if(in_array($nombreDia,$dias)){
                //aca tenemos que revizar si una fecha pertenece a la semana:
                $e = false;
                $f = Carbon::parse($fechasEntre[$i]);
                $t = Carbon::parse(Carbon::now());               
                $wef = $t->endOfWeek(Carbon::SUNDAY);
                $e = $wef->gt($f);
                $fdias [] = [
                    'fecha' => $fechasEntre[$i],
                    'numero_dia' => $diaDeLaSemana,
                    'nombre_dia' => $nombreDia,
                    'estado'=>$e,
                ];
            }
        }
        return $fdias;        
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
    public function profile_update(Request $request){
        $request->validate([
            'telefono' => 'required|min:9|max:9',
        ]);
        try {
            $cliente = Cliente::findOrFail(auth()->user()->ucliente->cliente_id);
            $cliente->telefono = $request->telefono;
            $cliente->update();
        } catch (\Throwable $th) {
            return Redirect::route('salud.app.profile')->with('error','error en la consulta');
        }
        return Redirect::route('salud.app.profile')->with('info','datos actualizados correctamente');
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
    public function password_edit(){
        return view('salud.app.password_edit');
    }
    public function password_update(Request $request){
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',             // Mínimo de 8 caracteres
                'regex:/[a-z]/',     // Debe contener al menos una letra minúscula
                'regex:/[A-Z]/',     // Debe contener al menos una letra mayúscula
            ],
            'password_confirmation' => 'required|same:password'    
        ]);
        try {
            //code...
            $user = User::findOrFail(auth()->user()->id);
            $user->password = bcrypt($request->password);
            $user->update();
        } catch (\Throwable $th) {
            return Redirect::route ('salud.app.password.edit')->with('error','error al actualizar la consulta');
        }
        return Redirect::route('salud.app.password.edit')->with('info','contraseña actualizada correctamente');
    }
    public function matriculas_index(){
        $user = User::findOrFail(auth()->id());
        $estudiantes = Estudiante::whereHas('postulante',function($query) use($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->orderBy('created_at','desc')->get();
        return view('salud.app.matriculas.index',compact('estudiantes'));
    }
    public function calificaciones_index(){
        $user = User::findOrFail(auth()->id());
        $estudiantes = Estudiante::whereHas('postulante',function($query) use($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->orderBy('created_at','desc')->get();
        return view('salud.app.calificaciones.index',compact('estudiantes'));
    }
    public function matriculas_show($id){
        //verificar si es su unidad didactica
        $user = User::findOrFail(auth()->id());
        $detalle = EmatriculaDetalle::findOrFail($id);
        $a = Uasignada::where('pmatricula_id','=',$detalle->matricula->pmatricula_id)
        ->where('udidactica_id','=',$detalle->udidactica_id)
        ->first();
        if(isset($a->horarios)){
            $fdias = $this->fdias($a);
        }else{
            $fdias = [];
        }
        if($detalle->matricula->estudiante->postulante->idCliente == $user->ucliente->cliente_id){
            return view('salud.app.matriculas.show',compact('detalle','fdias'));
        }else{
            return Redirect::route('estudiantes.matriculas.index')->with('error','no puedes acceder a esta informacion');
        }
    }
    public function calificaciones_pdf($id){
        $ciclos = ['I','II','III','IV','V','VI'];
        $estudiante = Estudiante::findOrFail($id);
        $pdf = PDF::loadview('salud.app.calificaciones.pdf',compact('estudiante','ciclos'));
		return $pdf->download('VE-'.$estudiante->postulante->cliente->dniRuc.'.'.'pdf');
        return view('salud.app.calificaciones.pdf',compact('estudiante','ciclos'));
    }
}

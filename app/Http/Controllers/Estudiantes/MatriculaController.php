<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Uasignada;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatriculaController extends Controller
{
    //
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
    public function index(){
        $user = User::findOrFail(auth()->id());
        $estudiantes = Estudiante::whereHas('postulante',function($query) use($user){
            $query->where('idCliente','=',$user->ucliente->cliente_id);
        })->orderBy('created_at','desc')->get();
        
        return view('estudiantes.matriculas.index',compact('user','estudiantes'));
    }
    public function show($id){
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
            return view('estudiantes.matriculas.show',compact('detalle','fdias'));
        }else{
            return Redirect::route('estudiantes.matriculas.index')->with('error','no puedes acceder a esta informacion');
        }
    }
}

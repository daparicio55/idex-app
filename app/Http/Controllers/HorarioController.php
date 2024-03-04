<?php

namespace App\Http\Controllers;

use App\Models\Uasignada;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $days = ['Lunes','Martes','Miercoles','Jueves','Viernes'];
        $uasignada = Uasignada::findOrFail($id);
        //contamos si tiene o no horarios
        if($uasignada->horarios->count()>0){
            return view('sacademica.uasignadas.horarios.edit',compact('uasignada','days'));
        }else{
            return view('sacademica.uasignadas.horarios.show',compact('uasignada','days'));
        }
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
    public function dn($dia){
        if($dia == "Lunes"){
            return 1;
        }
        if($dia == "Martes"){
            return 2;
        }
        if($dia == "Miercoles"){
            return 3;
        }
        if($dia == "Jueves"){
            return 4;
        }
        if($dia == "Viernes"){
            return 5;
        }
        if($dia == "Sabado"){
            return 6;
        }
        if($dia == "Domingo"){
            return 7;
        }
    }
    public function compararhoras($dia1,$hinicio1,$hfin1,$dia2,$hinicio2,$hfin2){
        try {
            //code...
            // Datos de la primera programación
            $primerDiaSemana = $this->dn($dia1); // Lunes (1), Martes (2), ..., Domingo (7)
            $primerHoraInicio = date('H:i:s',strtotime($hinicio1));
            $primerHoraFin = date('H:i:s',strtotime($hfin1));
            // Datos de la segunda programación
            $segundoDiaSemana = $this->dn($dia2); // Miércoles (3)
            $segundaHoraInicio = date('H:i:s',strtotime($hinicio2));
            $segundaHoraFin = date('H:i:s',strtotime($hfin2));

            // Convertir los días de la semana a números usando Carbon
            $primerFecha = Carbon::now()->next($primerDiaSemana);
            $segundaFecha = Carbon::now()->next($segundoDiaSemana);

            // Convertir las horas a objetos Carbon
            $primerHoraInicio = Carbon::createFromFormat('H:i:s', $primerHoraInicio);
            $primerHoraFin = Carbon::createFromFormat('H:i:s', $primerHoraFin);
            $segundaHoraInicio = Carbon::createFromFormat('H:i:s', $segundaHoraInicio);
            $segundaHoraFin = Carbon::createFromFormat('H:i:s', $segundaHoraFin);

            // Comparar si las fechas y horas cruzan
            if (
                $primerFecha->isSameDay($segundaFecha) &&
                ($primerHoraInicio->between($segundaHoraInicio, $segundaHoraFin) || $primerHoraFin->between($segundaHoraInicio, $segundaHoraFin))
            ) {
                // Cruzan
                if ($primerHoraFin->eq($segundaHoraInicio)){
                    return false;
                }
                if ($primerHoraInicio->eq($segundaHoraFin)){
                    return false;
                }
                return true;
            } else {
                // No cruzan
                return false;
            }


        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        
    }
    public function cf($dias,$finicio,$ffin){
        $filas = count($dias);
        $arr = [];
        for ($i=0; $i < $filas ; $i++ ){
            for ($z=0; $z < $filas; $z++) { 
                # code...
                if($z <> $i){
                    $r = [
                        'd1'=>$dias[$i],
                        'i1'=>$finicio[$i],
                        'f1'=>$ffin[$i],
                        'd2'=>$dias[$z],
                        'i2'=>$finicio[$z],
                        'f2'=>$ffin[$z],
                    ];
                    //array_push($arr,$r);
                    array_push($arr,$this->compararhoras($dias[$i],$finicio[$i],$ffin[$i],$dias[$z],$finicio[$z],$ffin[$z]));
                }
            }
        }
        return $arr;
    }


    public function update(Request $request, $id)
    {
        //return $this->cf($request->dias,$request->finicio,$request->ffin);
        try {
            //code...
            $uasignada = Uasignada::findOrFail($id);
            //revisar si tenemos conflictos
            if(in_array(true,$this->cf($request->dias,$request->finicio,$request->ffin))){
                return Redirect::route('sacademica.uasignadas.index')->with('error','hay un conflicto en las horas del docente en ');
            }
            $dias = [];
            $inicio = [];
            $fin = [];
            $uasignada = Uasignada::findOrFail($id);

            $uasignadas = Uasignada::where('user_id','=',$uasignada->user_id)
            ->whereNot('udidactica_id','=',$uasignada->udidactica_id)
            ->where('pmatricula_id','=',$uasignada->pmatricula_id)
            ->get();

            foreach ($uasignadas as $key => $ua) {
                # code...
                foreach ($ua->horarios as $horario) {
                    # code...
                    array_push($dias,$horario->day);
                    array_push($inicio,$horario->hinicio);
                    array_push($fin,$horario->hfin);
                }
            }
            $uasignada->snyc_horarios($request->dias,$request->finicio,$request->ffin);
            


        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index')->with('info','el horario se guardo de forma correcta');
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

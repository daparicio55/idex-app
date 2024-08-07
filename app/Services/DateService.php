<?php
namespace App\Services;

use App\Models\Docentes\Asistencias;
use App\Models\EmatriculaDetalle;
use App\Models\Uasignada;
use Carbon\Carbon;

class DateService
{
    public $mapeoTildes = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
        'ü' => 'u', 'Ü' => 'U', 'ñ' => 'n', 'Ñ' => 'N'
    ];
    function fdias($asignacione){
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
            $nombreDia = strtr($fecha->isoFormat('dddd'), $this->mapeoTildes);
            if(in_array($nombreDia,$dias)){
                //aca tenemos que revizar si una fecha pertenece a la semana:
                $e = false;
                $f = Carbon::parse($fechasEntre[$i]);
                $t = Carbon::parse(Carbon::now());
                //habilitar solo para la semana actual
                /* $wef = $f->endOfWeek(Carbon::SUNDAY);
                $wet = $t->endOfWeek(Carbon::SUNDAY);
                if ($wef->equalTo($wet)){
                    $e = true;
                } */
                //FIN
                //habiliutar para solo hasta la semana actual

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
    public function inability($emdetalle_id,$uasignada){
        $fechas = $this->fdias($uasignada);
        $faltas = Asistencias::where('emdetalle_id','=',$emdetalle_id)->where('estado','=','F')->get();
        $total_fechas = count($fechas);
        $maximo = $total_fechas * 0.30;
        $maximo = ceil($maximo);
        if(count($faltas) > $maximo){
            return true;
        }else{
            return false;
        }
    }
}


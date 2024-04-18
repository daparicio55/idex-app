<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use App\Models\Docentes\Asistencias;
use App\Models\EmatriculaDetalle;
use App\Models\Uasignada;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $ematricula = [];
        $asignacione = Uasignada::findOrFail($request->asignacione);
        $fdias = $this->fdias($asignacione);
        //matriculas regulares
        $ematricula_detalles = EmatriculaDetalle::whereHas('matricula',function($query) use($asignacione){
            $query->where('udidactica_id','=',$asignacione->udidactica_id)
            ->where('pmatricula_id','=',$asignacione->pmatricula_id);
        })->whereIn('tipo',['Regular','Repitencia'])->get();
        foreach ($ematricula_detalles as $key => $detalle) {
            # code...
            array_push($ematricula,[
                'id'=>$detalle->id,
                'apellido' => $detalle->matricula->estudiante->postulante->cliente->apellido,
                'nombre' => $detalle->matricula->estudiante->postulante->cliente->nombre,
            ]);
        }
        //ordenando el array
        usort($ematricula, function ($a, $b) {
            // Primero ordena por apellido
            $apellidoComparison = strcmp($a['apellido'], $b['apellido']);
        
            if ($apellidoComparison !== 0) {
                return $apellidoComparison;
            }
        
            // Si los apellidos son iguales, ordena por nombre
            return strcmp($a['nombre'], $b['nombre']);
        });
        //matriculas de equivalencia
        if(isset($asignacione->unidad->old->id)){
            $eqematricula_detalles = EmatriculaDetalle::whereHas('matricula',function($query) use($asignacione){
                $query->where('udidactica_id','=',$asignacione->unidad->old->id)
                ->where('pmatricula_id','=',$asignacione->pmatricula_id);    
            })->whereIn('tipo',['Regular','Repitencia'])
            ->get();
            //agregamos al ultimo las equivalencias en el array $ematricula
            foreach ($eqematricula_detalles as $key => $eqdetalle) {
                # code...
                array_push($ematricula,[
                    'id'=>$eqdetalle->id,
                    'apellido' => $eqdetalle->matricula->estudiante->postulante->cliente->apellido,
                    'nombre' => $eqdetalle->matricula->estudiante->postulante->cliente->nombre,
                ]);
            }
        }
        return view('docentes.cursos.asistencias.index',compact('asignacione','fdias','ematricula_detalles','ematricula'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {            
        try {
            foreach ($request->datos as $key => $dato) {
                # code...
                $data = explode(':',$dato);
                $asistencia = Asistencias::updateOrCreate(
                    ['fecha'=>$request->dia,'emdetalle_id'=>$data[0]],
                    [
                        'fecha' => $request->dia,
                        'estado' => $data[1],
                        'user_id' => auth()->id(),
                        'emdetalle_id' => $data[0],
                    ]
                );
            }
            $array = [
                'respuesta' =>'Correcto'
            ];  
            return $array;
        } catch (\Throwable $th) {
            //throw $th;
            $array = [
                'respuesta' =>$th->getMessage()
            ];
            return $array;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

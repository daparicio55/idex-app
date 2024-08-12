<?php

namespace App\Http\Controllers\Coordinaciones;

use App\Http\Controllers\Controller;
use App\Models\Ematricula;
use App\Models\Pmatricula;
use App\Models\Uasignada;
use App\Models\Udidactica;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:coordinaciones.reportes.index')->only('index');
        $this->middleware('can:coordinaciones.reportes.create')->only('create','store');
        $this->middleware('can:coordinaciones.reportes.edit')->only('edit','update');
        $this->middleware('can:coordinaciones.reportes.destroy')->only('destroy');
        $this->middleware('can:coordinaciones.reportes.show')->only('show');
    }

    protected function get_docentes(){
        $docentes = User::orderBy('name','asc')->wherehas('roles',function($query){
            $query->where('name','Docentes');
        })->orderBy('name','asc')->get();
        return $docentes;
    }
    protected function get_unidades(){
        $unidades = Udidactica::whereHas('modulo',function($query){
            $query->where('carrera_id',auth()->user()->coordinacion->idCarrera);
        })->get();
        return $unidades;
    }
    public function index(Request $request)
    {
        $docentes = $this->get_docentes();
        $unidades = $this->get_unidades();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        $resultados = null;
        if(isset($request->periodo)){
            $docente = $request->docente;
            $unidad = $request->unidad;
            $resultados = Uasignada::where('pmatricula_id',$request->periodo)
            ->whereHas('unidad.modulo',function($query){
                $query->where('carrera_id',auth()->user()->coordinacion->idCarrera);
            })->when($docente,function($q, $docente){
                return $q->where('user_id',$docente);
            })->when($unidad,function($f, $unidad){
                return $f->where('udidactica_id',$unidad);
            })
            ->get();
        }
        return view('coordinaciones.reportes.index',compact('docentes','unidades','periodos','resultados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $uasignada = Uasignada::findOrFail($id);
        $fechas = $this->fdias($uasignada);
        
        //tengo que poner la unidad didactica de equivalencia.
        $estudiantes = Ematricula::select('ematriculas.licencia','ematriculas.licenciaObservacion','clientes.nombre','clientes.apellido','clientes.dniRuc','admisiones.periodo','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
        ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
        ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
        ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
        ->join('admisiones','admisione_postulantes.admisione_id','=','admisiones.id')
        ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
        ->where('ematricula_detalles.tipo','<>','Convalidacion')
        ->where('ematricula_detalles.udidactica_id','=',$uasignada->udidactica_id)
        ->where('ematriculas.pmatricula_id','=',$uasignada->pmatricula_id)
        ->where(function($query){
            $query->where('ematricula_detalles.tipo','Regular')->orWhere('ematricula_detalles.tipo','Repitencia');
        })
        ->orderBy('clientes.apellido')
        ->orderBy('clientes.nombre')
        ->get();
        $data = [
            'uasignada'=>$uasignada,
            'estudiantes'=>$estudiantes
        ];
        return view('docentes.cursos.imprimir',compact('uasignada','estudiantes','fechas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $uasignada = Uasignada::findOrFail($id);
        $fechas = $this->fdias($uasignada);
        if(isset($uasignada->unidad->old->id)){
            $estudiantes = Ematricula::select('ematriculas.licencia','ematriculas.licenciaObservacion','clientes.nombre','clientes.apellido','clientes.dniRuc','admisiones.periodo','ematricula_detalles.tipo','ematricula_detalles.observacion','ematricula_detalles.id')
            ->join('ematricula_detalles','ematriculas.id','=','ematricula_detalles.ematricula_id')
            ->join('estudiantes','estudiantes.id','ematriculas.estudiante_id')
            ->join('admisione_postulantes','admisione_postulantes.id','=','estudiantes.admisione_postulante_id')
            ->join('admisiones','admisione_postulantes.admisione_id','=','admisiones.id')
            ->join('clientes','admisione_postulantes.idCliente','=','clientes.idCliente')
            ->where('ematricula_detalles.udidactica_id','=',$uasignada->unidad->old->id)
            ->where('ematriculas.pmatricula_id','=',$uasignada->pmatricula_id)
            ->where(function($query){
                $query->where('ematricula_detalles.tipo','Regular')->orWhere('ematricula_detalles.tipo','Repitencia');
            })
            ->orderBy('clientes.apellido')
            ->orderBy('clientes.nombre')
            ->get();
        }else{
            $estudiantes = null;
        }
        return view('docentes.cursos.equivalencia',compact('uasignada','estudiantes','fechas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    protected $mapeoTildes = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
        'ü' => 'u', 'Ü' => 'U', 'ñ' => 'n', 'Ñ' => 'N'
    ];
    protected function fdias($asignacione){
        //llenamos con los días de la semana que se lleva esta unidad didactica
        //dd($asignacione->horarios);
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
}

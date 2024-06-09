<?php

namespace App\Http\Controllers;

use App\Models\Capacidade;

use App\Models\Ematricula;
use App\Models\Pmatricula;
use App\Models\Uasignada;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DocenteCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docentes.cursos.index')->only('index');
        $this->middleware('can:docentes.cursos.create')->only('create','store');
        $this->middleware('can:docentes.cursos.edit')->only('edit','update');
        $this->middleware('can:docentes.cursos.destroy')->only('destroy');
        $this->middleware('can:docentes.cursos.show')->only('show');
        $this->middleware('can:docentes.cursos.imprimir')->only('imprimir');
        $this->middleware('can:docentes.cursos.equivalencia')->only('equivalencia');
    }
    public function index()
    {
        //seleccionamos las unidades que sea del ultimo periodo.
        $pmatricula = Pmatricula::select('id')->orderBy('nombre','desc')
        ->where('plan_cerrado','=',0)
        ->get();     
        
        /* $asignaciones = Uasignada::where('user_id','=',auth()->id())
        ->get(); */
        $asignaciones = Uasignada::whereHas('periodo',function($query){
            $query->where('plan_cerrado','=',0);
        })->where('user_id','=',auth()->id())
        ->orderBy('pmatricula_id','desc')
        ->get();
//        dd($asignaciones);
        return view('docentes.cursos.index',compact('asignaciones'));
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
        $asignacione = Uasignada::findOrFail($id);
        if ($asignacione->user_id <> Auth::id()){
            return Redirect::route('docentes.cursos.index')->with('error','error no puedes acceder a este curso');
        }
        return view('docentes.cursos.show',compact('asignacione'));
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
    public function imprimir($id){
        
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

    public function pdfregular($id){
        $uasignada = Uasignada::findOrFail($id);
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
        $pdf = PDF::loadView('docentes.cursos.imprimir',compact('uasignada','estudiantes'));
        return $pdf->download('invoice.pdf');
    }

    public function equivalencia($id){
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


}

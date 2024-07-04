<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use PDF;

class SacademicaReporteNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $carreras = Carrera::get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        $ciclos = ciclos();
        return view('sacademica.reportes.ordenmerito.index',compact('carreras','periodos','ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $matriculas = Ematricula::whereHas('estudiante.postulante',function($q) use($request){
            $q->where('idCarrera','=',$request->programa);
        })->whereHas('detalles.unidad',function($a) use($request){
            $a->where('ciclo','=',$request->ciclo);
        })->where('pmatricula_id','=',$request->periodo)
        ->get();
        
        $unis = Udidactica::whereHas('modulo',function($query) use($request){
            $query->where('carrera_id','=',$request->programa);
        })->where('ciclo','=',$request->ciclo)->get();
        $totalCreditos = $unis->sum('creditos');
        $estudiantes = [];
        foreach ($matriculas as $key => $matricula) {
            # debemos de tener 
            $unidades = [];
            $sumaNotas = 0;
            //verificamos que el detalle de la matricula se del ciclo seleccionado
            foreach ($matricula->detalles as $detalle) {
                if($detalle->unidad->ciclo == $request->ciclo && $detalle->tipo != "Convalidacion"){
                    $unidades[] = [
                        'id'=>$detalle->unidad->id,
                        'nombre'=>$detalle->unidad->nombre,
                        'creditos'=>$detalle->unidad->creditos,
                        'nota'=>$detalle->nota,
                    ];
                    $sumaNotas += $detalle->nota * $detalle->unidad->creditos;
                }
            }
            $estudiantes[] = [
                'dni'=>$matricula->estudiante->postulante->cliente->dniRuc,
                'nombre'=>$matricula->estudiante->postulante->cliente->nombre,
                'apellido'=>$matricula->estudiante->postulante->cliente->apellido,
                'telefono'=>$matricula->estudiante->postulante->cliente->telefono,
                'ponderado'=>round($sumaNotas/$totalCreditos,4),
                'unidades'=>$unidades,
            ];
        }
        usort($estudiantes, function ($a, $b) {
            return $b['ponderado'] <=> $a['ponderado'];
        });
        $ranking = 1;
        $last_ponderado = null;
        $ubicacion = 1;
        foreach ($estudiantes as $key => $estudiante) {
            if ($key > 0 && $estudiantes[$key - 1]['ponderado'] == $estudiante['ponderado']) {
                $estudiantes[$key]['ubicacion'] = $estudiantes[$key - 1]['ubicacion'];
                
            } else {
                // Sino, asigna una nueva ubicación
                $estudiantes[$key]['ubicacion'] = $ubicacion;
                $ubicacion++;
            }
            // Incrementa la ubicación para el próximo estudiante
        }

        usort($estudiantes, function($a, $b) {
            // Primero ordena por 'apellido'
            $cmp = strcmp($a['apellido'], $b['apellido']);
            if ($cmp !== 0) {
                return $cmp;
            }
            
            // Si 'apellido' es igual, entonces ordena por 'nombre'
            return strcmp($a['nombre'], $b['nombre']);
        });


        $acta = [
            'carrera'=>Carrera::find($request->programa)->nombreCarrera,
            'ciclo'=>$request->ciclo,
            'periodo'=>Pmatricula::find($request->periodo)->nombre,
            'estudiantes'=>$estudiantes,
        ];
        //return $acta;
        return view('sacademica.reportes.ordenmerito.create',compact('acta','unis'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function compararPonderado($a, $b) {
        if ($a['ponderado'] == $b['ponderado']) {
            return 0;
        }
        return ($a['ponderado'] < $b['ponderado']) ? -1 : 1;
    }
}

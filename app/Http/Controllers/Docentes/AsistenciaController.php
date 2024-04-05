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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $mapeoTildes = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ü' => 'u', 'Ü' => 'U', 'ñ' => 'n', 'Ñ' => 'N'
        ];
        $asignacione = Uasignada::findOrFail($request->asignacione);
        $dias = [];
        foreach ($asignacione->horarios as $key => $horario) {
            # code...
            $dias [] = strtolower($horario->day);
            
        }
        //return $dias;
        $fechaInicio = Carbon::parse($asignacione->periodo->finicio);
        $fechaFin = Carbon::parse($asignacione->periodo->ffin);
        $fechasEntre = [];
        // Añadimos la fecha de inicio al array
        $fechasEntre[] = $fechaInicio->toDateString();
        // Iteramos sobre las fechas desde la fecha de inicio hasta la fecha de fin
        while ($fechaInicio->addDay() <= $fechaFin) {
            // Añadimos cada fecha al array
            $fechasEntre[] = $fechaInicio->toDateString();
        }
        $fdias = [];
        for ($i=0; $i < count($fechasEntre); $i++) { 
            # code...
            $fecha = Carbon::parse($fechasEntre[$i]);
            $diaDeLaSemana = $fecha->isoFormat('E');
            $nombreDia =  strtr($fecha->isoFormat('dddd'), $mapeoTildes);
            if(in_array($nombreDia,$dias)){
                $fdias [] = [
                    'fecha' => $fechasEntre[$i],
                    'numero_dia' => $diaDeLaSemana,
                    'nombre_dia' => $nombreDia,
                ];
            }
            /* $fdias [] = [
                'fecha' => $fechasEntre[$i],
                'numero_dia' => $diaDeLaSemana,
                'nombre_dia' => $nombreDia,
            ]; */
        }
        return view('docentes.cursos.asistencias.index',compact('asignacione','fdias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //trar los estudiantes
        $asignacione = Uasignada::findOrFail($request->asignacione);
        $equivalencias = EmatriculaDetalle::whereHas('matricula',function ($query) use($asignacione){
            $query->where('udidactica_id','=',$asignacione->unidad->old->id)
            ->where('pmatricula_id','=',$asignacione->pmatricula_id)
            ->whereIn('ematricula_detalles.tipo',['Regular','Repitencia']);
        })->get();
        //return $equivalencias;
        return view('docentes.cursos.asistencias.create',compact('asignacione','equivalencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /* "asignacione": "420",
        "fecha": "2024-04-02",
        "r_emdetalle": [
        ],
        "rselect": [
        ],
        "e_emdetalle": [
        ],
        "eselect": [
        ] */
        
        try {
            //code...
            //verificamos si esta unidad didactica esta asignada a este usuario;
            $uasignada = Uasignada::findOrFail($request->asignacione);
            if($uasignada->user_id != Auth::id()){
                throw new Exception("No se puede guardar la asistencia", 1);
            }
            //agregamos las asistencias de los regulares;
            for ($i=0; $i < count($request->r_emdetalle) ; $i++) { 
                # code...
                $asistencia = new Asistencias();
                $asistencia->fecha = Carbon::now();
                $asistencia->estado = $request->rselect[$i];
                $asistencia->user_id = Auth::id();
                $asistencia->emdetalle_id = $request->r_emdetalle[$i];
                $asistencia->save();
            }
            for ($z=0; $z < count($request->e_emdetalle) ; $z++) { 
                # code...
                $asistencia = new Asistencias();
                $asistencia->fecha = Carbon::now();
                $asistencia->estado = $request->eselect[$z];
                $asistencia->user_id = Auth::id();
                $asistencia->emdetalle_id = $request->e_emdetalle[$z];
                $asistencia->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cursos.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cursos.index')->with('info','Se guardo la asistencia correctamente');
        return $request;
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
}

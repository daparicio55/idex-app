<?php

namespace App\Http\Controllers;

use App\Models\Cepre;
use App\Models\CepreEstudiante;
use App\Models\CepreEstudianteAsistencia;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CepreEstudianteAsistenciaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aulas = [
            [
                'id'=>1,
                'nombre'=>'Aula 1'
            ],
            [
                'id'=>2,
                'nombre'=>'Aula 2'
            ],
            [
                'id'=>3,
                'nombre'=>'Aula 3'
            ],
            [
                'id'=>4,
                'nombre'=>'Aula 4'
            ]
        ];
        $cepres = Cepre::orderBy('periodoCepre','desc')->get();

        return view('cepres.estudiantes.asistencias.index',compact('cepres','aulas'));
    }
    public function create(Request $request){
        $fecha = $request->fecha;
        $cepre = $request->idCepre;
        $estudiantes = Cliente::whereHas('cestudiantes',function($query) use($request){
            $query->where('aula','=',$request->aula)->where('idCepre','=',$request->idCepre);
        })->orderBy('apellido','asc')->orderBy('nombre','asc')
        ->get();

        return view('cepres.estudiantes.asistencias.create',compact('estudiantes','fecha','cepre'));
    }
    public function store(Request $request){
        try {
            //code...
            DB::beginTransaction();
            for ($i=0; $i < count($request->asistencias) ; $i++) { 
                # code...
                CepreEstudianteAsistencia::updateOrCreate([
                    'fecha'=>$request->fecha,
                    'cestudiante_id'=>$request->estudiantes[$i]
                ],[
                    'estado'=>$request->asistencias[$i],
                    'user_id'=>auth()->id()
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
        return Redirect::route('cepres.estudiantes.asistencias.index')->with('info','se guardo los datos correctamente');
    }
    public function show($id){
        $estudiante = CepreEstudiante::findOrFail($id);
        
        $fechaInicio = Carbon::parse($estudiante->cepre->fechaInicio);

        // Fecha actual
        $fechaActual = Carbon::now();
        
        // Generar un rango de fechas
        $rangoFechas = [];
        $currentDate = $fechaInicio->copy();

        while ($currentDate->lte($fechaActual)) {
            if ($currentDate->dayOfWeek !== 6 && $currentDate->dayOfWeek !== 0) {
                $rangoFechas[] = $currentDate->toDateString();
            }
            //$rangoFechas[] = $currentDate->toDateString();
            $currentDate->addDay(); // Agregar un día a la fecha actual
        }

        return view('cepres.estudiantes.asistencias.show',compact('estudiante','rangoFechas'));
    }
}
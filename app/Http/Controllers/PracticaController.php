<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estudiante;
use App\Models\Mformativo;
use App\Models\Practica;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Rmunate\Utilities\SpellNumber;

class PracticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.practicas.index')->only('index');
        $this->middleware('can:sacademica.practicas.create')->only('create','store');
        $this->middleware('can:sacademica.practicas.edit')->only('edit','update');
        $this->middleware('can:sacademica.practicas.destroy')->only('destroy');
        $this->middleware('can:sacademica.practicas.show')->only('show');
        $this->middleware('can:sacademica.practicas.conjunto')->only('conjunto');
        $this->middleware('can:sacademica.practicas.constancia')->only('constancia');
    }
    public function index(Request $request)
    {
        //
        if(isset($request->searchdni)){
            //vamos a buscar por dni
            $estudiantes = Estudiante::whereHas('postulante.cliente',function($query) use($request){
                $query->where('dniRuc','like','%'.$request->searchdni.'%')
                ->orWhere('apellido','like','%'.$request->searchdni.'%')
                ->orWhere('nombre','like','%'.$request->searchdni.'%');
            })->get();
        }else{
            $estudiantes = Estudiante::orderBy('id','desc')->paginate(10);
        }
        return view('sacademica.practicas.index',compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            //code...
            $estudiante = Estudiante::findOrFail($request->estudiante);
            $modulo = Mformativo::findOrFail($request->modulo);
            $empresas = DB::table('empresas')
            ->selectRaw('CONCAT(ruc, " ", razonSocial) AS nombre, idEmpresa as id')->pluck('nombre','id')
            ->toArray();
            $users = User::role('Docentes')->pluck('name','id')->toArray();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.practicas.create',compact('estudiante','modulo','empresas','users'));
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
        $request->validate([
            "empresa" =>"required" ,
            "user" => "required",
            "estudiante" => "required",
            "modulo" => "required",
            "calificacionempresa" => "required",
            "calificaciondocente" => "required",
            "finicio" => "required",
            "ffin" => "required",
            "fpresentacion" => "required",
            "horas" => "required",
            "expediente" => "required",
            "observacion" => "required"
        ]);
        try {
            //code...
            DB::beginTransaction();
            $practica = new Practica();
            $practica->empresa_id = $request->empresa;
            $practica->user_id = $request->user;
            $practica->estudiante_id = $request->estudiante;
            $practica->mformativo_id = $request->modulo;
            $practica->calificacionEmpresa = $request->calificacionempresa;
            $practica->calificacionDocente = $request->calificaciondocente;
            $practica->finicio= $request->finicio;
            $practica->ffin= $request->ffin;
            $practica->horas = $request->horas;
            $practica->fpresentacion = $request->fpresentacion;
            $practica->expediente = $request->expediente;
            $practica->observacion = $request->observacion;
            $practica->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
        return Redirect::route('sacademica.practicas.index')->with('info','se guardo la informacion correctamente');
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
        try {
            //code...
            $practica = Practica::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.practicas.show',compact('practica'));
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
        try {
            //code...
            $practica = Practica::findOrFail($id);
            $empresas = DB::table('empresas')
            ->selectRaw('CONCAT(ruc, " ", razonSocial) AS nombre, idEmpresa as id')->pluck('nombre','id')
            ->toArray();
            $users = User::role('Docentes')->pluck('name','id')->toArray();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.practicas.edit',compact('practica','empresas','users'));
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
        $request->validate([
            "empresa" =>"required" ,
            "user" => "required",
            "calificacionempresa" => "required",
            "calificaciondocente" => "required",
            "finicio" => "required",
            "ffin" => "required",
            "fpresentacion" => "required",
            "horas" => "required",
            "expediente" => "required",
            "observacion" => "required"
        ]);
        try {
            //code...
            DB::beginTransaction();
            $practica = Practica::findOrFail($id);
            $practica->empresa_id = $request->empresa;
            $practica->user_id = $request->user;
            $practica->calificacionEmpresa = $request->calificacionempresa;
            $practica->calificacionDocente = $request->calificaciondocente;
            $practica->finicio= $request->finicio;
            $practica->ffin= $request->ffin;
            $practica->horas = $request->horas;
            $practica->fpresentacion = $request->fpresentacion;
            $practica->expediente = $request->expediente;
            $practica->observacion = $request->observacion;
            $practica->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::route('sacademica.practicas.index')->with('info','se actualizo la informacion correctamente');
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
    public function conjunto($id){
        try {
            //code...
            $estudiante = Estudiante::findOrFail($id);
            //$nota = SpellNumber::integer(20)->toLetters();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.practicas.conjunto',compact('estudiante'));
    }
    public function constancia($id){
        try {
            //code...
            $estudiante = Estudiante::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.practicas.constancia',compact('estudiante'));
    }
}

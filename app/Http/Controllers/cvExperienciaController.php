<?php

namespace App\Http\Controllers;

use App\Models\cvExperiencia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\cvPersonale;
use App\Models\Personale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class cvExperienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $personal = cvPersonale::where('user_id','=',auth()->id())->first();
        return view('docentes.cv.experiencias.index',compact('personal'));
         if(!isset($personal)){
            return Redirect::route('docentes.cvs.index')->with('error','debe registrar primero los datos personales..');
        }
        return view('docentes.cv.experiencias.index',compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $exSector = ['Productivo'=>'Productivo','Educación'=>'Educación'];
        return view('docentes.cv.experiencias.create',compact('exSector'));
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
        try {
            //code...
            DB::beginTransaction();
            $personale = cvPersonale::where('user_id','=',auth()->id())->first();
            $experiencia = new cvExperiencia();
            $experiencia->exFechaInicio = $request->get('exFechaInicio');
            $experiencia->exFechaFin = $request->get('exFechaFin');
            $experiencia->exSector = $request->get('exSector');
            $experiencia->exTareas = $request->get('exTareas');
            $experiencia->exEmpresa = $request->get('exEmpresa');
            $experiencia->exCiudad = $request->get('exCiudad');
            $experiencia->exCargo = $request->get('exCargo');
            $experiencia->exDepartamento = $request->get('exDepartamento');
            $experiencia->exPais = $request->get('exPais');
            $experiencia->cv_personale_id = $personale->id;
            if($request->exActual == true){
                $experiencia->exActual = true;
            }else{
                $experiencia->exActual = false;
                $experiencia->exFechaFin = $request->get('exFechaFin');
            }
            $experiencia->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::route('docentes.cv.experiencias.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cv.experiencias.index')->with('info','la informacion de la experiencia laboral fue guardada correctamente');
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
        $experiencia = cvExperiencia::findOrFail($id);
        return view('docentes.cv.experiencias.show',compact('experiencia'));
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
        $exSector = ['Productivo'=>'Productivo','Educación'=>'Educación'];
        $experiencia = cvExperiencia::findOrFail($id);
        return view('docentes.cv.experiencias.edit',compact('experiencia','exSector'));
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
        try {
            //code...
            DB::beginTransaction();
            $experiencia = cvExperiencia::findOrFail($id);
            $experiencia->exFechaInicio = $request->get('exFechaInicio');
            if($request->exActual == true){
                $experiencia->exActual = true;
            }else{
                $experiencia->exActual = false;
                $experiencia->exFechaFin = $request->get('exFechaFin');
            }
            $experiencia->exSector = $request->get('exSector');
            $experiencia->exTareas = $request->get('exTareas');
            $experiencia->exEmpresa = $request->get('exEmpresa');
            $experiencia->exCiudad = $request->get('exCiudad');
            $experiencia->exCargo = $request->get('exCargo');
            $experiencia->exDepartamento = $request->get('exDepartamento');
            $experiencia->exPais = $request->get('exPais');
            $experiencia->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::route('docentes.cv.experiencias.index')->with('error','la informacion de la experiencia laboral no fue guardad correctamente :'.$th->getMessage());
        }
        return Redirect::route('docentes.cv.experiencias.index')->with('info','la informacion de la experiencia laboral no fue guardad correctamente');
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
        try {
            //code...
            $experiencia = cvExperiencia::findOrFail($id);
            $experiencia->delete();

        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cv.experiencias.index')->with('error','la informacion de la experiencia laboral no fue borrada correctamente :'.$th->getMessage());
        }
        return Redirect::route('docentes.cv.experiencias.index')->with('info','la informacion de la experiencia laboral fue eliminada correctamente');
    }
}

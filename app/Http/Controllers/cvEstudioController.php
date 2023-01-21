<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\cvEstudio;
use App\Models\cvPersonale;
use App\Models\Personale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class cvEstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        $personal = cvPersonale::where('user_id','=',auth()->id())->first();
        return view('docentes.cv.estudios.index',compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('docentes.cv.estudios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            DB::beginTransaction();
            //$idPersonal = DB::table('cv_personales')->where('id','=',auth()->id())->first();
            $personale = cvPersonale::where('user_id','=',auth()->id())->first();
            $estudio = new cvEstudio();
            $estudio->esTitulo = $request->get('esTitulo');
            $estudio->esInstitucion = $request->get('esInstitucion');
            $estudio->esAnioInicio = $request->get('esAnioInicio');
            $estudio->esMencion = $request->get('esMencion');
            $estudio->esAnioFin = $request->get('esAnioFin');
            $estudio->esCiudad = $request->get('esCiudad');
            $estudio->esDepartamento = $request->get('esDepartamento');
            $estudio->esPais = $request->get('esPais');
            $estudio->esDescripcion = $request->get('esDescripcion');
            $estudio->cv_personale_id = $personale->id;
            $estudio->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            dd($th->getMessage());
            return Redirect::to('docentes.cv.estudios.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cv.estudios.index')->with('info','la informacion de los estudios fue guardad correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudio = cvEstudio::findOrFail($id);
        return view('docentes.cv.estudios.show',compact('estudio'));
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
        $estudio = cvEstudio::findOrFail($id);
        return view('docentes.cv.estudios.edit',compact('estudio'));
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
            $estudio = cvEstudio::findOrFail($id);
            $estudio->esTitulo = $request->get('esTitulo');
            $estudio->esInstitucion = $request->get('esInstitucion');
            $estudio->esAnioInicio = $request->get('esAnioInicio');
            $estudio->esAnioFin = $request->get('esAnioFin');
            $estudio->esCiudad = $request->get('esCiudad');
            $estudio->esDepartamento = $request->get('esDepartamento');
            $estudio->esMencion = $request->get('esMencion');
            $estudio->esPais = $request->get('esPais');
            $estudio->esDescripcion = $request->get('esDescripcion');
            $estudio->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::route('docentes.cv.estudios.index')->with('error','la informacion de los estudios no fue actualizada correctamente :'.$th->getMessage());
        }
        return Redirect::route('docentes.cv.estudios.index')->with('info','la informacion de los estudios fue actualizada correctamente');
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
            $estudio = cvEstudio::findOrFail($id);
            $estudio->delete();

        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cv.estudios.index')->with('error','la informacion de los estudios no fue borrada correctamente :'.$th->getMessage());
        }
        return Redirect::route('docentes.cv.estudios.index')->with('info','la informacion de los estudios fue eliminada correctamente');
    
    }
}

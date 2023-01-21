<?php

namespace App\Http\Controllers;

use App\cvCapacitacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class cvCapacitacionController extends Controller
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
        
        $personal = DB::table('cv_personales')->where('id','=',auth()->id())->first();
        //seleccionamos todos los estudios
        $capacitaciones = DB::table('cv_capacitaciones')
        ->where('idPersonal','=',$personal->idPersonal)
        ->get();
        return view('cv.capacitaciones.index',compact('capacitaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cv.capacitaciones.create');
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
            $idPersonal = DB::table('cv_personales')->where('id','=',auth()->id())->first();
            $capacitacion = new cvCapacitacion();
            $capacitacion->caNombre = $request->get('caNombre');
            $capacitacion->caInstitucion = $request->get('caInstitucion');
            $capacitacion->caFechaInicio = $request->get('caFechaInicio');
            $capacitacion->caFechaFin = $request->get('caFechaFin');
            $capacitacion->caCiudad = $request->get('caCiudad');
            $capacitacion->caDepartamento = $request->get('caDepartamento');
            $capacitacion->caPais = $request->get('caPais');
            $capacitacion->caDescripcion = $request->get('caDescripcion');
            $capacitacion->idPersonal = $idPersonal->idPersonal;
            $capacitacion->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::to('cv/capacitaciones')->with('error','la informacion de la capacitacion no fue guardad correctamente :'.$th->getMessage());
        }
        return Redirect::to('cv/capacitaciones')->with('info','la informacion de la capacitacion fue guardad correctamente');
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
        $capacitacion = cvCapacitacion::findOrFail($id);
        return view('cv.capacitaciones.show',compact('capacitacion'));
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
        $capacitacion = cvCapacitacion::findOrFail($id);
        return view('cv.capacitaciones.edit',compact('capacitacion'));
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
            $capacitacion = cvCapacitacion::findOrFail($id);
            $capacitacion->caNombre = $request->get('caNombre');
            $capacitacion->caInstitucion = $request->get('caInstitucion');
            $capacitacion->caFechaInicio = $request->get('caFechaInicio');
            $capacitacion->caFechaFin = $request->get('caFechaFin');
            $capacitacion->caCiudad = $request->get('caCiudad');
            $capacitacion->caDepartamento = $request->get('caDepartamento');
            $capacitacion->caPais = $request->get('caPais');
            $capacitacion->caDescripcion = $request->get('caDescripcion');
            $capacitacion->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return Redirect::to('cv/capacitaciones')->with('error','la informacion de las capacitaciones no fue actualizada correctamente :'.$th->getMessage());
        }
        return Redirect::to('cv/capacitaciones')->with('info','la informacion de las capacitacion fue actualizada correctamente');
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
            $capacitacion = cvCapacitacion::findOrFail($id);
            $capacitacion->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cv/capacitaciones')->with('error','la informacion de las capacitaciones no fue borrada correctamente :'.$th->getMessage());
        }
        return Redirect::to('cv/capacitaciones')->with('info','la informacion de las capacitaciones fue eliminada correctamente');
    }
}

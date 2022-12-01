<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisioneVacante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdmisioneVacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('can:admisiones.vacantes.index')->only('index');
        $this->middleware('can:admisiones.vacantes.create')->only('create','store');
        $this->middleware('can:admisiones.vacantes.edit')->only('edit','update');
        $this->middleware('can:admisiones.vacantes.destroy')->only('destroy');
        $this->middleware('can:admisiones.vacantes.show')->only('show');
        $this->middleware('can:admisiones.vacantes.anular')->only('anular'); */
    }
    public function index(Request $request)
    {
        //
        $admisione = Admisione::findOrFail($request->id);
        $vacantes = AdmisioneVacante::all();
        return view('admisiones.vacantes.index',compact('admisione','vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $admisione = Admisione::findOrFail($request->id);
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        return view('admisiones.vacantes.create',compact('carreras','admisione'));
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
            $vacantes = new AdmisioneVacante;
            $vacantes->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/vacantes/?id='.$request->admisione_id)->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/vacantes/?id='.$request->admisione_id)->with('info','se registro la cantidad de vacantes correctamente');
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
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $vacante = AdmisioneVacante::findOrFail($id);
        return view('admisiones.vacantes.edit',compact('vacante','carreras'));
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
            $vacante = AdmisioneVacante::findOrFail($id);
            $vacante->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/vacantes/?id='.$vacante->admisione_id)->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/vacantes/?id='.$vacante->admisione_id)->with('info','se actualizo la cantidad de vacantes correctamente');
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
            $vacante = AdmisioneVacante::findOrFail($id);
            $vacante->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/vacantes/?id='.$vacante->admisione_id)->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/vacantes/?id='.$vacante->admisione_id)->with('info','se elimino correctamente la informacion de la vacante');
    }
}

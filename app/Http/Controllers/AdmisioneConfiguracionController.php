<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdmisioneConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('can:admisiones.configuraciones.index')->only('index');
        $this->middleware('can:admisiones.configuraciones.create')->only('create','store');
        $this->middleware('can:admisiones.configuraciones.edit')->only('edit','update');
        $this->middleware('can:admisiones.configuraciones.destroy')->only('destroy');
        $this->middleware('can:admisiones.configuraciones.show')->only('show');
        $this->middleware('can:admisiones.configuraciones.anular')->only('anular'); */
    }
    public function index()
    {
        //
        $admisiones = Admisione::orderBy('periodo','desc')->get();
        return view('admisiones.configuraciones.index',compact('admisiones'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admisiones.configuraciones.create');
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
            $admisione = new Admisione;
            $admisione->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se registro correctamente el proceso de admision');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $admisione = Admisione::findOrFail($id);
        return view('admisiones.configuraciones.edit',compact('admisione'));
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
        try {
            //code...
            $admisione = Admisione::findOrFail($id);
            $admisione->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se actualizo correctamente el proceso de admision');
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
            $admisione = Admisione::findOrFail($id);
            $admisione->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se elmino el proceso de admision correctamente');
    }
}

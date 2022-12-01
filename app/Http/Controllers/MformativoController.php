<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Iformativo;
use App\Models\Mformativo;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MformativoController extends Controller
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
        $modulos = Mformativo::orderBy('id','desc')->get();
        return view('sacademica.mformativos.index',compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $itinerarios = Iformativo::pluck('nombre','id')->toArray();
        return view('sacademica.mformativos.create',compact('carreras','itinerarios'));
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
            $modulo = new Mformativo;
            $modulo->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos')->with('info','se guardo el nuevo modulo formativo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ahora vamos a poner como si fuera el index de las unidades didacticas
        $modulo = Mformativo::findOrFail($id);
        $unidades = Udidactica::where('mformativo_id','=',$id)->get();
        return view('sacademica.mformativos.show',compact('unidades','modulo'));
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
        $itinerarios = Iformativo::pluck('nombre','id')->toArray();
        $modulo = Mformativo::findOrFail($id);
        return view('sacademica.mformativos.edit',compact('carreras','itinerarios','modulo'));
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
            $modulo = Mformativo::findOrFail($id);
            $modulo->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos')->with('info','se actualizo correctamente el modulo formativo');
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
            $modulo = Mformativo::findOrFail($id);
            $modulo->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos')->with('info','se elimino correctamente el modulo formativo');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cepre;
use App\Models\CepreSumativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CepreSumativoConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.sumativos.configuraciones.index')->only('index');
        $this->middleware('can:cepres.sumativos.configuraciones.create')->only('create','store');
        $this->middleware('can:cepres.sumativos.configuraciones.edit')->only('edit','update');
        $this->middleware('can:cepres.sumativos.configuraciones.destroy')->only('destroy');
        $this->middleware('can:cepres.sumativos.configuraciones.show')->only('show');
    }
    public function index()
    {
        //
        $sumativos = CepreSumativo::orderBy('id','desc')->get();
        return view('cepres.sumativos.configuraciones.index',compact('sumativos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cepres = Cepre::orderBy('periodoCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        return view('cepres.sumativos.configuraciones.create',compact('cepres'));
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
            CepreSumativo::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/sumativos/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/configuraciones')->with('info','la informacion del sumativo se guardo correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //VERIFICAMOS SI CREAMOS O MODIFICAMOS
        $sumativo = CepreSumativo::findOrFail($id);
        if (count($sumativo->alternativas) == 0){
            return view('cepres.sumativos.respuestas.create',compact('sumativo'));
        }else{
            return view('cepres.sumativos.respuestas.edit',compact('sumativo'));
        }
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
        $sumativo = CepreSumativo::findOrFail($id);
        $cepres = Cepre::orderBy('periodoCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        return view('cepres.sumativos.configuraciones.edit',compact('cepres','sumativo'));
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
            $sumativo = CepreSumativo::findOrFail($id);
            $sumativo->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cerpres/sumativos/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/configuraciones')->with('info','se actualizo el sumativo correctamente');
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
            $sumativo = CepreSumativo::findOrFail($id);
            $sumativo->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cerpres/sumativos/configuraciones')->with('error',$th->getMessage()); 
        }
        return Redirect::to('cepres/sumativos/configuraciones')->with('info','se elimino el sumativo correctamente');
    }
}

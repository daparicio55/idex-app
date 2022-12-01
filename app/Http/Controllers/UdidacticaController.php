<?php

namespace App\Http\Controllers;

use App\Models\Mformativo;
use App\Models\Udidactica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UdidacticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $tUnidades = tUnidades();
        $modulo = Mformativo::findOrFail($request->id);
        return view('sacademica.udidacticas.create',compact('modulo','tUnidades'));
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
            $unidad = new Udidactica;
            $unidad->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos/'.$request->mformativo_id)->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos/'.$request->mformativo_id)->with('info','se guardo la unidad didactica correctamente');
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
        $tUnidades = tUnidades();
        $unidad = Udidactica::findOrFail($id);
        return view('sacademica.udidacticas.edit',compact('unidad','tUnidades'));
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
            $unidad = Udidactica::findOrFail($id);
            $unidad->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos/'.$unidad->mformativo_id)->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos/'.$unidad->mformativo_id)->with('info','se actualizo la unidad didactica correctamente');
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
            $unidad = Udidactica::findOrFail($id);
            $unidad->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/mformativos/'.$unidad->mformativo_id)->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/mformativos/'.$unidad->mformativo_id)->with('info','se elimino la unidad didactica correctamente');
    }
}

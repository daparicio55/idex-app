<?php

namespace App\Http\Controllers;

use App\Models\Iformativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IformativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.iformativos.index')->only('index');
        $this->middleware('can:sacademica.iformativos.create')->only('create','store');
        $this->middleware('can:sacademica.iformativos.edit')->only('edit','update');
        $this->middleware('can:sacademica.iformativos.destroy')->only('destroy');
        $this->middleware('can:sacademica.iformativos.show')->only('show');
    }
    public function index()
    {
        //
        $itinerarios = Iformativo::all();
        return view('sacademica.iformativos.index',compact('itinerarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sacademica.iformativos.create');
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
            $itinerario = new Iformativo;
            $itinerario->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/iformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/iformativos')->with('info','se registro el itinerario formativo correctamente');
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
        $itinerario = Iformativo::findOrFail($id);
        return view('sacademica.iformativos.edit',compact('itinerario'));
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
            $itinerario = Iformativo::findOrFail($id);
            $itinerario->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/iformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/iformativos')->with('info','se actualizo el itinerario formativo correctamente');
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
            $itinerario = Iformativo::findOrFail($id);
            $itinerario->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/iformativos')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/iformativos')->with('info','se elimino el modulo formativo correctamente');
    }
}

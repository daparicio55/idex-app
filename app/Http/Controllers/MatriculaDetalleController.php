<?php

namespace App\Http\Controllers;

use App\Models\EmatriculaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatriculaDetalleController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $detalle = EmatriculaDetalle::findOrFail($id);
            $detalle->nota = $request->nota;
            $detalle->update();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.'.$request->origen.'.index')
            ->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.'.$request->origen.'.index')
        ->with('info','se edito el registro correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        try {
            //code...
            $detalle = EmatriculaDetalle::findOrFail($id);
            $detalle->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('sacademica.'.$request->origen.'.index')
            ->with('error',$th->getMessage());
        }
        return Redirect::route('sacademica.'.$request->origen.'.index')
        ->with('info','se actualizo el registro correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:accesos.oficinas.index')->only('index');
        $this->middleware('can:accesos.oficinas.create')->only('create','store');
        $this->middleware('can:accesos.oficinas.edit')->only('edit','update');
        $this->middleware('can:accesos.oficinas.destroy')->only('destroy');
        $this->middleware('can:accesos.oficinas.show')->only('show');
    }
    public function index()
    {
        //
        $oficinas = Oficina::all();
        return view('accesos.oficinas.index',compact('oficinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('accesos.oficinas.create');
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
            Oficina::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/oficinas')->with('error','no registro la nueva oficina, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/oficinas')->with('info','se registro la nueva oficina correctamente');
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
    public function edit(Oficina $oficina)
    {
        //
        return view('accesos.oficinas.edit',compact('oficina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oficina $oficina)
    {
        //
        try {
            //code...
            $oficina->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/oficinas')->with('error','no se actualizo la oficina, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/oficinas')->with('info','se actualizo la oficina correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oficina $oficina)
    {
        try {
            //code...
            $oficina->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('accesos/oficinas')->with('error','no se elmino la oficina correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('accesos/oficinas')->with('info','se elmino la oficina correctamente');
    }
}

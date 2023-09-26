<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Mformativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AbilityController extends Controller
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
    public function index(Request $request)
    {
        //
        try {
            //code...
            $modulo = Mformativo::findOrFail($request->mformativo_id);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.ability.index',compact('modulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            //code...
            $modulo = Mformativo::findOrFail($request->mformativo_id);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.ability.create',compact('modulo'));
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
        $request->validate([
            'nombre'=>'required',
            'mformativo_id'=>'required'
        ]);
        try {
            //code...
            $ability = new Ability();
            $ability->nombre = $request->nombre;
            $ability->mformativo_id = $request->mformativo_id;
            $ability->save();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::to('/sacademica/ability?mformativo_id='.$request->mformativo_id)->with('info','se guardo la capacidad correctamente');
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
        try {
            $ability = Ability::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return view('sacademica.ability.edit',compact('ability'));
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
            $ability = Ability::findOrFail($id);
            $ability->nombre = $request->nombre;
            $ability->save();

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::to('/sacademica/ability?mformativo_id='.$ability->mformativo_id)->with('info','se actualizo la capacidad correctamente');
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
            $ability = Ability::findOrFail($id);
            $ability->delete();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::to('/sacademica/ability?mformativo_id='.$ability->mformativo_id)->with('info','se elimino la capacidad correctamente');
    }
}

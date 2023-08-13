<?php

namespace App\Http\Controllers;

use App\Models\Uasignada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HorarioController extends Controller
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
        $days = ['Lunes','Martes','Miercoles','Jueves','Viernes'];
        $uasignada = Uasignada::findOrFail($id);
        //contamos si tiene o no horarios
        if($uasignada->horarios->count()>0){
            return view('sacademica.uasignadas.horarios.edit',compact('uasignada','days'));
        }else{
            return view('sacademica.uasignadas.horarios.show',compact('uasignada','days'));
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
            $uasignada = Uasignada::findOrFail($id);
            $uasignada->snyc_horarios($request->dias,$request->finicio,$request->ffin);
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return Redirect::route('sacademica.uasignadas.index');
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
    }
}

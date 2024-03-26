<?php

namespace App\Http\Controllers;

use App\Models\Iformativo;
use App\Models\Pmatricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PmatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.pmatriculas.index')->only('index');
        $this->middleware('can:sacademica.pmatriculas.create')->only('create','store');
        $this->middleware('can:sacademica.pmatriculas.edit')->only('edit','update');
        $this->middleware('can:sacademica.pmatriculas.destroy')->only('destroy');
        $this->middleware('can:sacademica.pmatriculas.show')->only('show');
    }
    public function index()
    {
        //
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        return view('sacademica.pmatriculas.index',compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('sacademica.pmatriculas.create');
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
            $periodo = new Pmatricula;
            $periodo->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/pmatriculas/')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/pmatriculas/')->with('info','se registro el periodo academico correctamente');
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
        $periodo = Pmatricula::findOrFail($id);
        return view('sacademica.pmatriculas.show',compact('periodo'));
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
        $periodo = Pmatricula::findOrFail($id);
        return view('sacademica.pmatriculas.edit',compact('periodo'));
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
            $periodo = Pmatricula::findOrFail($id);
            $periodo->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/pmatriculas/')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/pmatriculas/')->with('info','se actualizo el periodo de matricula correctamente');
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
            $periodo = Pmatricula::findOrFail($id);
            $periodo->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/pmatriculas/')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/pmatriculas/')->with('info','se elimino correctamente el periodo academico');
    }
    public function plancierre($id){
        try {
            //code...
            $periodo = Pmatricula::findOrFail($id);
            if($periodo->plan_cerrado == true){
                $periodo->plan_cerrado = false;
                $periodo->save();
            }else{
                $periodo->plan_cerrado = true;
                $periodo->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('sacademica/pmatriculas/')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/pmatriculas/')->with('info','se cambio correctamente el estado del periodo academico');
        dd($id);
    }
}

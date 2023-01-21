<?php

namespace App\Http\Controllers;

use App\Models\cvConocimiento;
use App\Models\cvPersonale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class cvConocimientoController extends Controller
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
        $personale = cvPersonale::where('user_id','=',auth()->id())->first();
        if (isset($personale->conocimientos)){
            return view('docentes.cv.conocimientos.edit',compact('personale'));
        }
        return view('docentes.cv.conocimientos.create',compact('personale'));
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
            $conocimiento = new cvConocimiento();
            $conocimiento->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cvs.index')->with('error',$th->getMessage());
        }       
        return Redirect::route('docentes.cvs.index')->with('info','se guardo la informacion correctamente');
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
            $conocimiento = cvConocimiento::findOrFail($id);
            $conocimiento->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('docentes.cvs.index')->with('error',$th->getMessage());
        }       
        return Redirect::route('docentes.cvs.index')->with('info','se actualizo la informacion correctamente');
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

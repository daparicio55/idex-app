<?php

namespace App\Http\Controllers;

use App\Models\Squestion;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaludEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        //
        $surveys = Survey::orderBy('id','desc')->get();
        return view('salud.encuestas.index',compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('salud.encuestas.create');
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
            DB::beginTransaction();
            $survey = new Survey;
            $survey->create($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('salud.encuestas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.index')->with('info','se guardo correctamente la encuesta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //mandamos al index de las preguntas
        $survey = Survey::findOrFail($id);
        return view('salud.encuestas.preguntas.index',compact('survey'));
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
        $survey = Survey::findOrFail($id);
        return view('salud.encuestas.edit',compact('survey'));
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
            $survey = Survey::findOrFail($id);
            $survey->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('salud.encuestas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.index')->with('info','se actualizo correctamente la encuesta');
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
            $survey = Survey::findOrFail($id);
            $survey->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('salud.encuestas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.index')->with('info','se elimino correctamente la encuesta');
    }
}

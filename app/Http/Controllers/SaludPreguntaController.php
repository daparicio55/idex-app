<?php

namespace App\Http\Controllers;

use App\Models\Squestion;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaludPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:salud.preguntas.index')->only('index');
        $this->middleware('can:salud.preguntas.create')->only('create','store');
        $this->middleware('can:salud.preguntas.edit')->only('edit','update');
        $this->middleware('can:salud.preguntas.destroy')->only('destroy');
        $this->middleware('can:salud.preguntas.show')->only('show');
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
    public function create(Request $request)
    {
        $survey = Survey::findOrFail($request->survey_id);
        return view('salud.encuestas.preguntas.create',compact('survey'));
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
            $squestion = new Squestion;
            $squestion->create($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('salud.encuestas.show',[$request->survey_id])->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.show',[$request->survey_id])->with('info','se guardo la pregunta correctamente');
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
        $squestion = Squestion::findOrFail($id);
        return view('salud.encuestas.alternativas.index',compact('squestion'));
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
        $squestion = Squestion::findOrFail($id);
        return view('salud.encuestas.preguntas.edit',compact('squestion'));
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
            $squestion = Squestion::findOrFail($id);
            $squestion->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('salud.encuestas.show',[$squestion->survey->id])->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.show',[$squestion->survey->id])->with('info','se actualizo la pregunta correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $squestion = Squestion::findOrFail($id);
            $survey_id = $squestion->survey_id;
            $squestion->delete();
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('salud.encuestas.show',[$survey_id])->with('error',$th->getMessage());
        }
        return Redirect::route('salud.encuestas.show',[$survey_id])->with('info','se eliminio la pregunta correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\SurveyExport;
use App\Models\Squestion;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SaludEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:salud.encuestas.index')->only('index');
        $this->middleware('can:salud.encuestas.create')->only('create','store');
        $this->middleware('can:salud.encuestas.edit')->only('edit','update');
        $this->middleware('can:salud.encuestas.destroy')->only('destroy');
        $this->middleware('can:salud.encuestas.show')->only('show');
    }
    public function index()
    {
        //
        $surveys = Survey::orderBy('id','desc')
        ->get();
        return view('salud.encuestas.index',compact('surveys'));
    }
    public function download($id){
        $survey = Survey::findOrFail($id);
        //return view('exports.survey',compact('survey'));
        return Excel::download(new SurveyExport($id), $survey->type.'-'.$survey->id.'.xlsx');        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $types = [
            'Encuestas'=>'Encuestas',
            'Psicologia'=>'Psicologia'
        ];
        return view('salud.encuestas.create',compact('types'));
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
        $types = [
            'Encuestas'=>'Encuestas',
            'Psicologia'=>'Psicologia'
        ];
        $survey = Survey::findOrFail($id);
        return view('salud.encuestas.edit',compact('survey','types'));
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

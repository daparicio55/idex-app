<?php

namespace App\Http\Controllers;

use App\Models\Cepre;
use App\Models\CepreEstudiante;
use Illuminate\Http\Request;

class CepreCarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.carnets.index')->only('index');
        $this->middleware('can:cepres.carnets.create')->only('create','store');
        $this->middleware('can:cepres.carnets.edit')->only('edit','update');
        $this->middleware('can:cepres.carnets.destroy')->only('destroy');
        $this->middleware('can:cepres.carnets.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $cepres = Cepre::orderBy('periodoCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        if(isset($request->idCepre)){
            //tenemos hacer los carnets
            $cepre = Cepre::findOrFail($request->idCepre);
            $estudiantes = CepreEstudiante::where('idCepre','=',$cepre->idCepre)->get();
            /* dd($estudiantes[1]->carrera->nombreCarrera); */
            return view('cepres.carnets.imprimir',compact('cepre','estudiantes'));
        }
        
        return view('cepres.carnets.index',compact('cepres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //+
        $cepre = Cepre::findOrFail($request->idCepre);
        $estudiantes = CepreEstudiante::where('idCepre','=',$request->idCepre)->get();
        return view('cepres.carnets.create',compact('estudiantes','cepre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cepre = Cepre::findOrFail($request->idCepre);
        $estudiantes = CepreEstudiante::whereIn('idCepreEstudiante',$request->alumnos)->get();
        return view('cepres.carnets.imprimir',compact('cepre','estudiantes'));
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

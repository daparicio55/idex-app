<?php

namespace App\Http\Controllers;

use App\Models\Cepre;
use App\Models\CepreEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CepreCruzeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.cruzes.index')->only('index');
        $this->middleware('can:cepres.cruzes.create')->only('create','store');
        $this->middleware('can:cepres.cruzes.edit')->only('edit','update');
        $this->middleware('can:cepres.cruzes.destroy')->only('destroy');
        $this->middleware('can:cepres.cruzes.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $cepres = Cepre::orderBy('periodoCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        if(isset($request->idCepre)){
            //tenemos hacer los carnets
            $cepre = Cepre::findOrFail($request->idCepre);
            $estudiantes = CepreEstudiante::where('idCepre','=',$cepre->idCepre)->get();
            return view('cepres.pagos.cruzes.index',compact('cepres','cepre','estudiantes'));
        }
        return view('cepres.pagos.cruzes.index',compact('cepres'));

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

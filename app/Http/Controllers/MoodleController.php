<?php

namespace App\Http\Controllers;

use App\Models\Ematricula;
use App\Models\Pmatricula;
use Illuminate\Http\Request;

class MoodleController extends Controller
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
        $periodo = Pmatricula::orderBy('nombre','desc')->pluck('nombre','id')->toArray();
        if(isset($request->id)){
            $matriculados = Ematricula::where('pmatricula_id','=',$request->id)
            ->get();
            $maximo = 0;
            foreach ($matriculados as $matriculado) {
                # code...
                $contador = 0;
                foreach($matriculado->detalles as $detalle){
                    if($detalle->tipo <> 'Convalidacion'){
                        $contador ++;
                    }
                }
                if($contador>$maximo){
                    $maximo = $contador;
                }
                $contador=0;
            }
            return view('sacademica.ematriculas.moodle.index',compact('periodo','matriculados','maximo'));    
        }
        return view('sacademica.ematriculas.moodle.index',compact('periodo'));
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

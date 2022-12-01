<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CepreSumativoAlternativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CepreSumativoAlternativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.sumativos.respuestas.index')->only('index');
        $this->middleware('can:cepres.sumativos.respuestas.create')->only('create','store');
        $this->middleware('can:cepres.sumativos.respuestas.edit')->only('edit','update');
        $this->middleware('can:cepres.sumativos.respuestas.destroy')->only('destroy');
        $this->middleware('can:cepres.sumativos.respuestas.show')->only('show');
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
            $preguntas = count($request->pregunta);
            for ($i=1; $i <= $preguntas ; $i++) { 
            $respuesta = new CepreSumativoAlternativa;
            $respuesta->pregunta = $i;
            $respuesta->respuesta = $request->pregunta[$i-1];
            $respuesta->cepre_sumativo_id = $request->cepre_sumativo_id;
            $respuesta->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('cepres/sumativos/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/configuraciones')->with('info','se guardo las alternativas correctamente');
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
            DB::beginTransaction();
            foreach ($request->id as $pregunta) {
                $alternativa = CepreSumativoAlternativa::findOrFail($pregunta);
                $alternativa->respuesta = $request->$pregunta;
                $alternativa->update();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('cepres/sumativos/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('cepres/sumativos/configuraciones')->with('info','se actualizo las alternativas correctamente');
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

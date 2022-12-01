<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisioneAlternativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdmisioneAlternativaController extends Controller
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
        try {
            //code...
            DB::beginTransaction();
            $preguntas = count($request->pregunta);
            for ($i=1; $i <= $preguntas ; $i++) {
                $respuesta = new AdmisioneAlternativa;
                $respuesta->numPregunta = $i;
                $respuesta->respuesta = $request->pregunta[$i-1];
                $respuesta->admisione_id = $request->admisione_id;
                $respuesta->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se registro las respuestas correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ahora tenemos que ver si se crea o se edita
        $alternativas = AdmisioneAlternativa::where('admisione_id','=',$id)->get();
        $admisione = Admisione::findOrFail($id);
        if (count($alternativas)>0){
            //quiere decir que vamos a editar
            //tengo q recuperar las alternativas guardadas
            return view('admisiones.ordinarios.respuestas.edit',compact('admisione','alternativas'));
        }else{
            //aca vamos a crear
            return view('admisiones.ordinarios.respuestas.create',compact('admisione'));
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
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se edito las claves de las respuestas correctamente');
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
                $alternativa = AdmisioneAlternativa::findOrFail($pregunta);
                $alternativa->respuesta = $request->$pregunta;
                $alternativa->update();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/configuraciones')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/configuraciones')->with('info','se actualizo las claves de las respuestas correctamente');
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

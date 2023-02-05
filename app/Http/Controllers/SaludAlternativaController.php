<?php

namespace App\Http\Controllers;

use App\Models\Sqalternative;
use App\Models\Squestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaludAlternativaController extends Controller
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
    public function create(Request $request)
    {
        $squestion = Squestion::findOrFail($request->squestion_id);
        return view('salud.encuestas.alternativas.create',compact('squestion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            DB::beginTransaction();
            $sqalternative = new Sqalternative;
            $sqalternative->squestion_id = $request->squestion_id;
            $sqalternative->name_es = $request->name_es;
            $sqalternative->name_awa = $request->name_awa;
            if(isset($request->required)){
                $sqalternative->required = 1;
            }
            $sqalternative->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('salud.preguntas.show',[$request->squestion_id])
            ->with('error',$th->getMessage());
        }
        return Redirect::route('salud.preguntas.show',[$request->squestion_id])
        ->with('info','la alternativa se registro correctamente');
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
        $sqalternative = Sqalternative::findOrFail($id);
        return view('salud.encuestas.alternativas.edit',compact('sqalternative'));
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
            $sqalternative = Sqalternative::findOrFail($id);
            $sqalternative->name_es = $request->name_es;
            $sqalternative->name_awa = $request->name_awa;
            if(isset($request->required)){
                $sqalternative->required = 1;
            }else{
                $sqalternative->required = 0;
            }
            $sqalternative->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('salud.preguntas.show',[$sqalternative->question->id])
            ->with('error',$th->getMessage());
        }
        return Redirect::route('salud.preguntas.show',[$sqalternative->question->id])
        ->with('info','se actualizo la alternativa correctamente');
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
            $sqalternative = Sqalternative::findOrFail($id);
            $question_id = $sqalternative->squestion_id;
            $sqalternative->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('salud.preguntas.show',[$question_id])
            ->with('error',$th->getMessage());
        }
        return Redirect::route('salud.preguntas.show',[$question_id])
        ->with('info','se elimino correctamente la alternativa');
    }
}

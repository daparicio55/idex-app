<?php

namespace App\Http\Controllers;

use App\Models\Ematricula;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LicenciaController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $matricula = Ematricula::findOrFail($id);
            $matricula->licencia = "SI";
            $matricula->licenciaObservacion = $request->licenciaObservacion;
            $matricula->save();
            //modifico la tabla de estudiante
            $estudiante = Estudiante::findOrFail($matricula->estudiante_id);
            $estudiante->licencia = "SI";
            $estudiante->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/matriculas')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/matriculas')->with('info','se registro la licencia correctamente');
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
        try {
            //code...
            DB::beginTransaction();
            $matricula = Ematricula::findOrFail($id);
            $matricula->licencia = "NO";
            $matricula->licenciaObservacion="";
            $matricula->save();
            //modifico la tabla de estudiante
            $estudiante = Estudiante::findOrFail($matricula->estudiante_id);
            $estudiante->licencia = "NO";
            $estudiante->save();
            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/matriculas')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/matriculas')->with('info','se eliminó la licencia correctamente');
    }
}

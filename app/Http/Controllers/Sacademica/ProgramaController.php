<?php

namespace App\Http\Controllers\Sacademica;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Iformativo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $programas = Carrera::get();
        return view('sacademica.programas.index',compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programa = Carrera::find($id);
        $itinerarios = Iformativo::pluck('nombre','id')->toArray();
        $programaAnterior = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $coordinadores = User::whereDoesntHave('roles', function($query){
            $query->where('name','Bolsa User');
        })->orderBy('name','asc')->pluck('name','id')->toArray();
        $coordinadores[0] = 'Seleccione Coordinador';
        return view('sacademica.programas.edit',compact('programa','itinerarios','programaAnterior','coordinadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //code...
            $programa = Carrera::findOrFail($id);
            $programa->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
            return Redirect::route('sacademica.programas.index')->with('error','no se actualizo el programa exitosamente');
        }
        return Redirect::route('sacademica.programas.index')->with('info','se actualizo el programa exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

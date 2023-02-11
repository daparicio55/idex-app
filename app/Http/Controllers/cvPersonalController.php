<?php

namespace App\Http\Controllers;

use App\cvPersonales;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\cvPersonale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class cvPersonalController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //verificamos primero si ya no tiene registrado sus datos si no editarlos
        $personal = cvPersonale::where('user_id','=',auth()->id())->first();
        //$personal = DB::table('cv_personales')->where('id','=',auth()->id())->first();
        if(isset($personal)){
            //editamos
            return view('docentes.cv.personales.edit',compact('personal'));
        }
        return view('docentes.cv.personales.create');
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
        //dd($request);
        try {
            //code...
            DB::beginTransaction();
            if($request->hasFile('file')){
                $url = Storage::put('fotoscv',$request->file('file'));
            }else{
                $url = 'fotoscv/default.png';
            }
            $personales = new cvPersonale();
            $personales->apellidos = $request->get('apellidos');
            $personales->nombres = $request->get('nombres');
            $personales->dni = $request->get('dni');
            $personales->ncolegiatura = $request->get('ncolegiatura');
            $personales->telefono = $request->get('telefono');
            $personales->perDireccion = $request->get('direccion');
            $personales->perCiudad = $request->get('perCiudad');
            $personales->perDepartamento = $request->get('perDepartamento');
            $personales->correoInstitucional = $request->get('correoInstitucional');
            $personales->perTitulo = $request->get('perTitulo');
            $personales->perPerfil = $request->get('perPerfil');
            $personales->perFoto = $url;
            $personales->user_id = auth()->id();
            $personales->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('docentes.cvs.index')->with('error',$th->getMessage());
        }
        return Redirect::route('docentes.cvs.index')->with('info','la informacion de los datos personales se registro correctamente');
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
            $personales = cvPersonale::findOrFail($id);
            $personales->apellidos = $request->get('apellidos');
            $personales->nombres = $request->get('nombres');
            $personales->dni = $request->get('dni');
            $personales->ncolegiatura = $request->get('ncolegiatura');
            $personales->telefono = $request->get('telefono');
            $personales->perDireccion = $request->get('direccion');
            $personales->perCiudad = $request->get('perCiudad');
            $personales->perDepartamento = $request->get('perDepartamento');
            $personales->correoInstitucional = $request->get('correoInstitucional');
            $personales->perTitulo = $request->get('perTitulo');
            $personales->perPerfil = $request->get('perPerfil');
            if($request->hasFile('file')){
                //borrar el arrchivo anterior;
                //Storage::delete($personales->file);
                //ahora guardar el nuevo archivo
                $url = Storage::put('fotoscv',$request->file('file'));
                $personales->perFoto = $url;
            }
            $personales->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('docentes.cvs.index')->with('error','la informacion de los datos personales no se actualizo correctamente, ERROR: '.$th->getMessage());
        }
        return Redirect::route('docentes.cvs.index')->with('info','la informacion de los datos personales se actualizo correctamente');
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

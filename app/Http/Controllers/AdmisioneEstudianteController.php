<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdmisioneEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admisiones.estudiantes.index')->only('index');
        $this->middleware('can:admisiones.estudiantes.create')->only('create','store');
        $this->middleware('can:admisiones.estudiantes.edit')->only('edit','update');
        $this->middleware('can:admisiones.estudiantes.destroy')->only('destroy');
        $this->middleware('can:admisiones.estudiantes.show')->only('show');
        $this->middleware('can:admisiones.estudiantes.anular')->only('anular');
    }
    public function index(Request $request)
    {
        //
        $admisiones = Admisione::orderBy('nombre','desc')->pluck('nombre','id');
        if(isset($request->id)){
            $admision = Admisione::findOrFail($request->id);
            //cantidad de postulantes
            $pOrdinarios = AdmisionePostulante::where('modalidadTipo','Ordinario')
            ->where('admisione_id',$admision->id)
            ->where('anulado','=','NO')
            ->orderBy('idCarrera','asc')
            ->orderBy('total','desc')
            ->get();
            $pExonerados = AdmisionePostulante::where('modalidadTipo','Exonerado')
            ->where('admisione_id',$admision->id)
            ->where('anulado','=','NO')
            ->get();
            $carreras = Carrera::where('observacionCarrera','=','visible')
            ->orderBy('nombreCarrera','asc')->get();
            return view('admisiones.estudiantes.index',compact('admisiones','admision','pOrdinarios','pExonerados','carreras'));
        }
        return view('admisiones.estudiantes.index',compact('admisiones'));
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
                foreach ($request->postulante_id as $id){
                    # code...
                    $estudiante = new Estudiante;
                    $estudiante->admisione_postulante_id = $id;
                    $estudiante->save();
                }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('admisiones/estudiantes')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/estudiantes')->with('info','se guardaron los estudiantes correctamente');
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
        try {
            //code...
            $estudiante = Estudiante::where('admisione_postulante_id','=',$id)->first();
            if(isset($estudiante->id)){
                $estudiante->delete();
            }else{
                $new =  new Estudiante;
                $new->admisione_postulante_id = $id;
                $new->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/estudiantes/')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/estudiantes/')->with('info','se cambio el estado correctamente');
    }
}

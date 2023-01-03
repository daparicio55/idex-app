<?php

namespace App\Http\Controllers;

use App\Models\Ematricula;
use App\Models\EmatriculaDetalle;
use App\Models\Udidactica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VerificacioneAvanzadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('can:accesos.usuarios.index')->only('index');
        $this->middleware('can:accesos.usuarios.create')->only('create','store');
        $this->middleware('can:accesos.usuarios.edit')->only('edit','update');
        $this->middleware('can:accesos.usuarios.destroy')->only('destroy');
        $this->middleware('can:accesos.usuarios.show')->only('show'); */
    }
    public function index()
    {
        //redirigir a create
        //return Redirect::to('sacademica/verificacionesas/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        //return view('sacademica.verificacionesas.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ahora guardamos para el periodo de matricula
        //dd($request);;
        try {
            //code...
            //ciclo.. 
            $ciclo = Udidactica::findOrFail($request->id[0]);
            DB::beginTransaction();
            $matricula = new Ematricula;
            $matricula->tipo = "Regular";
            $matricula->fecha = $request->fecha;
            $matricula->boleta = "000";
            $matricula->pmatricula_id = $request->pmatricula_id;
            $matricula->estudiante_id = $request->estudiante_id;
            $matricula->user_id = auth()->id();
            $matricula->observacion = $ciclo->ciclo;
            $matricula->save();
            //guardamos los detalles
            $ids = $request->id;
            $notas = $request->notas;
            $cantidad = count($ids);
            for ($i=0; $i < $cantidad ; $i++) { 
                # code...
                if ($notas[$i] != 'NM'){
                    $detalles = new EmatriculaDetalle;
                    $detalles->tipo = "Regular";
                    $detalles->udidactica_id = $ids[$i];
                    $detalles->ematricula_id = $matricula->id;
                    $detalles->nota = $notas[$i];
                    $detalles->observacion = $request->fecha;
                    $detalles->save();
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/estudiantes')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/estudiantes')->with('info','se registro los datos correctamente');
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

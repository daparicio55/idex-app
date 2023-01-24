<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SaludappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('salud.app.index');
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
        $validate = $request->validate([
            'dni'=>'required',
            'fecha'=>'required'
        ]);
        //ahora verificamos si la fecha de nacimiento coincide con lo informado.
        $cliente = Cliente::where('dniRuc','=',$request->dni)->first();
        $dni = $request->dni;
        $fecha = $request->fecha;
        $cantidad = Cliente::whereHas('postulaciones',function($query) use ($dni,$fecha){
            $query->where('dniRuc','=',$dni)->where('fechaNacimiento','=',$fecha);
        })->count();

        $cliente = Cliente::whereHas('postulaciones',function($query) use ($dni,$fecha){
            $query->where('dniRuc','=',$dni)->where('fechaNacimiento','=',$fecha);
        })->first();
        if ($cantidad == 0){      
            return Redirect::route('salud.app.index')->with('error','los datos son incorrectos');
        }

        $estudiante = Estudiante::whereHas('postulante.cliente',function($query) use($dni){
            $query->where('dniRuc','=',$dni);
        })->first();
        return view('salud.app.show',compact('cliente','estudiante'));
        //return Redirect::route('salud.app.show',['app'=>$cliente->idCliente]);
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
        dd($id);
        
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
    public function profile($id){
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.profile',compact('estudiante'));
    }
    public function atencione($id){
        $estudiante = Estudiante::findOrFail($id);
        return view('salud.app.atencione',compact('estudiante'));
    }
}

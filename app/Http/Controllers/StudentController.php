<?php

namespace App\Http\Controllers;

use App\Mail\CorreoMail;
use App\Models\Cliente;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ///
        if(isset($request->dni)){
            $cliente = Cliente::where('dniRuc','=',$request->dni)->first();
            return view('students.index',compact('cliente'));
        }
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        if(isset($request->dni)){
            $cliente = Cliente::where('dniRuc','=',$request->dni)->first();
            return view('students.create',compact('cliente'));
        }
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* ingresamos el cliente */
        
        //vamos a mandar el correo

        $cliente = Cliente::findOrFail($request->idCliente);

        $details = [
            'title'=>'Alta sistema SisGe IDEX Perú Japón',
            'body'=>'Bienvenido, este correo es la confirmación de tu alta en el sistema SisGe IDEX Perú Japón, este sistema en fase de prueba, 
            Ahora tienes que confirmar una nueva contraseña para ingresar.
            Recuerda que tu nombre de usuario siempre será tu correo institucional.'
        ];
        Mail::to($cliente->dniRuc.'@idexperujapon.edu.pe')->send(new CorreoMail($details));
        return "se envio el correo";
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
        $estudiante = Estudiante::findOrfail($id);
        $pdf = PDF::loadview('students.imprimir',['estudiante'=>$estudiante]);
        return $pdf->download($estudiante->postulante->cliente->dniRuc.'-'.$estudiante->postulante->carrera->nombreCarrera.'.pdf');
        /* return view('students.imprimir',compact('estudiante')); */
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

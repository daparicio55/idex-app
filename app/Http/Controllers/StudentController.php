<?php

namespace App\Http\Controllers;

use App\Mail\CorreoMail;
use App\Models\Cliente;
use App\Models\EmatriculaDetalle;
use App\Models\Estudiante;
use App\Models\Udidactica;
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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:students.index')->only('index');
        $this->middleware('can:students.create')->only('create','store');
        $this->middleware('can:students.edit')->only('edit','update');
        $this->middleware('can:students.destroy')->only('destroy');
        $this->middleware('can:students.show')->only('show');
		$this->middleware('can:students.anular')->only('anular');
    }
    public function index(Request $request)
    {
        if(isset($request->dni)){
            $cliente = Cliente::where('dniRuc','=',$request->dni)->first();
            $datos = $this->getData($request->dni);
            $object = (object) $datos;
            return view('students.show',compact('datos','object'));
            //return view('students.index',compact('cliente'));
        }
        return view('students.index');
    }
    public function getData($dni){
        $query = Cliente::where('dniRuc','=',$dni)->first();
        $data = null;
        $data_postulaciones = null;
        if (isset($query->idCliente)){
            $cliente = Cliente::findOrFail($query->idCliente);
            $data_client = [
                'nombres' => $cliente->nombre,
                'apellidos' => $cliente->apellido,
                'dni' => $cliente->dniRuc,
                'telefono' => $cliente->telefono,
                'telefono2' => $cliente->telefono2
            ];
            #recorremos las postulaciones que tiene el cliente
            foreach ($cliente->postulaciones as $key => $postulacione) {
                # ingresamos las postulaciones del cliente
                if(isset($postulacione->estudiante->id)){
                    $unidades = $this->getCiclos($postulacione);
                    $data_postulaciones [] = [
                        'programa' => $postulacione->carrera->nombreCarrera,
                        'periodo' => $postulacione->admisione->nombre,
                        'ciclos' => $unidades,
                    ];
                }
            }          
        }
        
        $data = [
            'cliente'=> $data_client,
            'carreras' => $data_postulaciones,
        ];
        return $data;
    }
    public function getCiclos($postulacione){
        $ciclos = [
            'I',
            'II',
            'III',
            'IV',
            'V',
            'VI'
        ];
        $response = null;
        foreach ($ciclos as $key => $ciclo) {
            # code...
            $unidades = $this->getUnidades($postulacione,$ciclo);

            $response [] = [
                'nombre' => $ciclo,
                'unidades'=> $unidades,
            ];
        }
        return $response;
    }
    public function getUnidades($postulacione,$ciclo){
        $datos = Udidactica::whereHas('modulo',function($query) use($postulacione,$ciclo){
            $query->where('carrera_id','=',$postulacione->idCarrera)
            ->where('ciclo',$ciclo);
        })->orderBy('tipo','desc')->orderBy('nombre','asc')->get();
        $response = null;
        foreach ($datos as $key => $dato) {
            # code...
            $matriculas = $this->getMatriculas($postulacione,$dato);
            $response [] = [
                'id'=>$dato->id,
                'nombre'=>$dato->nombre,
                'tipo'=>$dato->tipo,
                'creditos'=>$dato->creditos,
                'horas'=>$dato->horas,
                'matriculas'=>$matriculas,
            ];
        }
        return $response;
    }
    public function getMatriculas($postulacione,$unidad){
        $matriculas = EmatriculaDetalle::whereHas('matricula',function($query) use($postulacione, $unidad){
            $query->where('estudiante_id','=',$postulacione->estudiante->id)
            ->where('udidactica_id','=',$unidad->id);
        })->get();
        $response = [];
        foreach ($matriculas as $key => $matricula) {
            # code...
            $response [] = [
                'tipo' => $matricula->tipo,
                'nota' => $matricula->nota,
                'color' => $matricula->nota > 12 ? 'primary' : 'danger',
                'periodo' => $matricula->matricula->matricula->nombre,
            ];
        }
        return $response;
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

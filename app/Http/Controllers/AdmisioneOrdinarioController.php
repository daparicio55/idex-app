<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisioneAlternativa;
use App\Models\AdmisioneMarcada;
use App\Models\AdmisionePostulante;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdmisioneOrdinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $admisiones = Admisione::orderBy('nombre','desc')->pluck('nombre','id');
        if(isset($request->id)){
            $admision = Admisione::findOrFail($request->id);
            //cantidad de postulantes
            $postulantes = AdmisionePostulante::where('modalidadTipo','Ordinario')
            ->where('admisione_id',$admision->id)
            ->get();
            return view('admisiones.ordinarios.index',compact('admisiones','admision','postulantes'));
        }
        return view('admisiones.ordinarios.index',compact('admisiones'));
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
    public function bono(Request $request,$id){
        try {
            //code...
            $postulante = AdmisionePostulante::findOrFail($id);
            $postulante->bonificacion = $request->bonificacion;
            $postulante->update();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/ordinarios/?id='.$postulante->admisione_id)->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/ordinarios/?id='.$postulante->admisione_id)->with('info','se registro la informacion de las bonificaciones correctamente');
        
    }
    public function bonificaciones(Request $request, $id){
        try {
            //code...
            set_time_limit(0);
            $admisione = Admisione::findOrFail($id);
            if($request->hasFile('csv')){
                $file = $request->file('csv');
                $f = fopen($file, 'r');
                $linea = 0;
                while (($datos = fgetcsv($f,0,';')) !== false){
                    //ingresamos una nueva linea
                    if($linea != 0){
                        //vamos a buscar la primera el DNI y el numero
                        $cliente = Cliente::where('dniRuc','=',$datos[0])->first();
                        $postulante = AdmisionePostulante::where('idCliente','=',$cliente->idCliente)
                        ->where('admisione_id','=',$id)
                        ->first();
                        $postulante->bonificacion = $datos[1];
                        $postulante->update();
                    }
                    $linea ++;
                }   
                fclose($f);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/ordinarios/?id='.$id)->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/ordinarios/?id='.$id)->with('info','se registro la informacion de las bonificaciones correctamente');
    }
    public function resultados($id){
        $admisione = Admisione::findOrFail($id);
        $resultados = AdmisionePostulante::where('admisione_id','=',$id)
        ->where('modalidadTipo','=','Ordinario')
        ->where('anulado','=','NO')
        ->orderBy('idCarrera','asc')
        ->orderBy('total','desc')
        ->get();
        return view ('admisiones.ordinarios.resultados',compact('resultados','admisione'));
    }
    public function subircsv(Request $request,$id)
    {
        try {
            //code...
            set_time_limit(0);
            //DB::beginTransaction();
            //borramos las anteriores
            AdmisioneMarcada::where('admisione_id','=',$id)->delete();
            
            //buscamos los datos del proceso de admision
            $admisione = Admisione::findOrFail($id);
            $preguntas = $admisione->preguntas;
            if($request->hasFile('csv')){
                $file = $request->file('csv');
                $f = fopen($file, 'r');
                $linea = 0;
                while (($datos = fgetcsv($f,0,';')) !== false){
                    //ingresamos una nueva linea
                    if($linea != 0){
                        
                        /* for ($i=1; $i <=$preguntas ; $i++) { 
                            //ingresamos la primera
                            $respuesta = new AdmisioneMarcada;
                            $respuesta->dni = $datos[0];
                            $respuesta->pregunta = $i;
                            $respuesta->marcada = $datos[$i];
                            $respuesta->admisione_id = $id;
                            $respuesta->save();
                            
                        } */
                        $registros = [];
                        for ($i = 1; $i <= $preguntas; $i++) {
                            $registros[] = [
                                'dni' => $datos[0],
                                'pregunta' => $i,
                                'marcada' => $datos[$i],
                                'admisione_id' => $id,
                            ];
                        }
                        AdmisioneMarcada::insert($registros);
                    }
                    $linea ++;
                }   
                fclose($f);
            }
            //ahora que ya tenemos las respuestas
            //vamos a poner los puntajes
            $postulantes = AdmisionePostulante::where('admisione_id','=',$id)
            ->where('modalidadTipo','=','Ordinario')
            ->get();
            $cantidad = count($postulantes);
            //dd($cantidad);
            $progress=0;
            session()->put('progress', $progress);
            foreach ($postulantes as $key=>$postulante) {
                # code...
                //vamos a seleccionar todos los campos de la tabla marcada
                $respuestas = AdmisioneMarcada::where('dni','=',$postulante->cliente->dniRuc)
                ->where('admisione_id','=',$id)
                ->orderBy('pregunta','asc')
                ->get();
                $correctas = 0;
                $incorrectas = 0;
                $blancas = 0;
                //ahora vamos a calcular las pregruntas si estan correctas o incorrectas.
                foreach ($respuestas as $respuesta) {
                    # code...
                    //ahora verificamos en que condicion esta la respuesta
                    //buscamos la repuesta correcta
                    $correcta = AdmisioneAlternativa::where('admisione_id',$id)
                    ->where('numPregunta','=',$respuesta->pregunta)
                    ->first();
                    if (isset($respuesta->marcada)){
                        //
                        if($respuesta->marcada == $correcta->respuesta){
                            //pregunta correcta
                            $correctas++;
                        }else{
                            //pregunta incorrecta
                            $incorrectas++;
                        }
                    }else{
                        //esta en blanco
                        $blancas ++;
                    }
                }
                $postulante->correctas = $correctas;
                $postulante->incorrectas = $incorrectas;
                $postulante->blanco = $blancas;
                $postulante->puntaje = ($correctas*$admisione->puntos)-($incorrectas*$admisione->encontra);
                $postulante->total = (($correctas*$admisione->puntos)-($incorrectas*$admisione->encontra)) + $postulante->bonificacion;
                $postulante->update();
                // ahora tenemos que guardar los datos en la tabla de postulantes; */
                $request->session()->put('progress', $key+1);
            }
            //DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('admisiones/ordinarios/?id='.$id)->with('error',$th->getMessage());
        }
        //ahora que tengo los puntajes puestos es hora de mostrar los resultados
        //retornamos a la pagina
        return Redirect::to('admisiones/ordinarios/?id='.$id)->with('info','se registro la informacion de las fichas de admisión');
    }
}

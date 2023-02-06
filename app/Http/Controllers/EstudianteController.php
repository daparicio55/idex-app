<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Iformativo;
use App\Models\Pmatricula;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $buscar;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sacademica.estudiantes.index')->only('index');
        $this->middleware('can:sacademica.estudiantes.create')->only('create','store');
        $this->middleware('can:sacademica.estudiantes.edit')->only('edit','update');
        $this->middleware('can:sacademica.estudiantes.destroy')->only('destroy');
        $this->middleware('can:sacademica.estudiantes.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $searchText = NULL;
        if (isset($request->searchText)) {
            # code...
            //ahora que hay código vamos a buscar
            $searchText = $request->searchText;
            //vamos a mostrar a los alumnos que tenemos
            $this->buscar = $request->searchText;
            $estudiantes = Estudiante::whereHas('postulante.cliente',function($query){
                $query->where('dniRuc',$this->buscar)
                ->orWhere('apellido','like','%'.$this->buscar.'%')
                ->orWhere('nombre','like','%'.$this->buscar.'%');
            })->get();
        }else{
            $estudiantes = Estudiante::orderBy('id','desc')->paginate(15);
        }
        return view ('sacademica.estudiantes.index',compact('estudiantes','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $sexos = ['Masculino'=>'Masculino','Femenino'=>'Femenino'];
        $modalidadTipo = ['Ordinario'=>'Ordinario','Exonerado'=>'Exonerado'];
        $modalidad = [
            'Ordinario'=>'Ordinario',
            'Artista Calificado'=>'Artista Calificado',
            'Comunidades Nativas y Campesinas'=>'Comunidades Nativas y Campesinas',
            'Desplazados Terrorismo y combatientes del Cenepa'=>'Desplazados Terrorismo y combatientes del Cenepa',
            'Personas con Discapacidad'=>'Personas con Discapacidad',
            '1er y 2do Puesto EBR - EBA'=>'1er y 2do Puesto EBR - EBA',
            '1er y 2do Puesto Cepre IDEX Perú Japón'=>'1er y 2do Puesto Cepre IDEX Perú Japón',
            'Servicio Militar'=>'Servicio Militar',
            'Deportistas Calificados'=>'Deportistas Calificados',
            'Traslado Interno'=>'Traslado Interno',
            'Titulados'=>'Titulados',
            'Reingresantes'=>'Reingresantes'
        ];
        $cliente = BuscarDni('vacio');
        $searchText = null;
        if(isset($request->searchText)){
            //buscar datos del DNI
            $cliente = BuscarDni($request->searchText);
            $searchText = $request->searchText;
        }
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $admisiones = Admisione::orderby('periodo','desc')->pluck('periodo','id')->toArray();
        return view ('sacademica.estudiantes.create',compact('cliente','searchText','carreras','admisiones','sexos','modalidadTipo','modalidad'));
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
            DB::beginTransaction();
            //actualizamos el cliente
            $cliente = Cliente::findOrFail($request->idCliente);
            $cliente->apellido = $request->apellido;
            $cliente->nombre = $request->nombre;
            $cliente->telefono = $request->telefono;
            $cliente->telefono2 = $request->telefono2;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->update();
            //vamos a meter el numero de expediente
            $numero = DB::table('admisione_postulantes')
            ->orderBy('expediente','desc')
            ->where('admisione_id',$request->admisione_id)
            ->first();
            if(isset($numero)){
                $expediente = $numero->expediente + 1;
            }else{
                $expediente = 1;
            }
            $hora = Carbon::now()->toTimeString();
            $fecha = Carbon::now()->toDateString();
            //ingresamos la postulacion
            $postulante = new AdmisionePostulante;
            $postulante->fecha = $fecha;
            $postulante->hora = $hora;
            $postulante->expediente = $expediente;
            $postulante->sexo = $request->sexo;
            $postulante->discapacidad = $request->discapacidad;
            $postulante->discapacidadNombre = $request->discapacidadNombre;
            $postulante->modalidadTipo = 'Exonerado';
            $postulante->modalidad = 'Historico';
            $postulante->url = 'noimagen';
            $postulante->fechaNacimiento = $request->fechaNacimiento;
            $postulante->idCliente = $request->idCliente;
            $postulante->idCarrera = $request->idCarrera;
            $postulante->admisione_id = $request->admisione_id;
            $postulante->colegio_id = 102;
            $postulante->boleta = $request->boleta;
            $postulante->user_id = auth()->user()->id;
            $postulante->save();
            //ahora lo registramos como estudiante
            $estudiante = new Estudiante;
            $estudiante->admisione_postulante_id = $postulante->id;
            $estudiante->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/estudiantes')->with('error','error: '.$th->getMessage());
        }
        return Redirect::to('sacademica/estudiantes')->with('info','se registro correctamente la informacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadena = explode(":",$id);
        //aca voy a poner las verificaciones Avanzadas.
        $estudiante = Estudiante::findOrFail($cadena[0]);
        $ciclo = $cadena[1];
        //vamos a mostrar las unidades didacticas que deberia tener el alumno
        $periodos = Pmatricula::pluck('nombre','id')->toArray();
        $itineario = Iformativo::findOrFail($estudiante->postulante->carrera->iformativo_id);
        //dd($estudiante->postulante->idCarrera);
        //verificamos si ya tiene un ingreso de notas
        
        return view('sacademica.estudiantes.show',compact('itineario','estudiante','ciclo','periodos'));
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
        //vamos a eliminar el estudiante y se anulara su postulacion
        try {
            //code...
            DB::beginTransaction();
            $estudiante = Estudiante::findOrFail($id);
            //anular el postulante.
            $postulante = AdmisionePostulante::findOrFail($estudiante->admisione_postulante_id);
            $postulante->anulado = "SI";
            $postulante->save();
            $estudiante->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('sacademica/estudiantes')->with('error',$th->getMessage());
        }
        return Redirect::to('sacademica/estudiantes')->with('info','se elimino el estudiante correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admisione;
use App\Models\AdmisionePostulante;
use App\Models\Carrera;
use App\Models\Cliente;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdmisionePostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admisiones.postulantes.index')->only('index');
        $this->middleware('can:admisiones.postulantes.create')->only('create','store');
        $this->middleware('can:admisiones.postulantes.edit')->only('edit','update');
        $this->middleware('can:admisiones.postulantes.destroy')->only('destroy');
        $this->middleware('can:admisiones.postulantes.show')->only('show');
        $this->middleware('can:admisiones.postulantes.anular')->only('anular');
    }
    public function index(Request $request)
    {
        //
        $searchText = null;
        if (isset($request->searchText)) {
            # code...
            //ahora que hay código vamos a buscar
            $searchText = $request->searchText;
            
            $postulantes = AdmisionePostulante::whereHas('cliente',function($query) use ($searchText){
                $query->where('dniRuc','like','%'.$searchText.'%')->orWhere('apellido','like','%'.$searchText.'%');
            })->paginate(25);
        }else{
            $postulantes = AdmisionePostulante::orderBy('id','desc')->paginate(25);
        }
        return view('admisiones.postulantes.index',compact('postulantes','searchText'));
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
            'Titulados'=>'Titulados',
            'Reingresantes'=>'Reingresantes',
            'Traslado Interno'=>'Traslado Interno',
            'Traslado Externo'=>'Traslado Externo'
        ];
        $cliente = BuscarDni('vacio');
        $searchText = null;
        if(isset($request->searchText)){
            //buscar datos del DNI
            $cliente = BuscarDni($request->searchText);
            $searchText = $request->searchText;
        }
        $carreras = Carrera::where('observacionCarrera','=','visible')->pluck('nombreCarrera','idCarrera')->toArray();
        $admisiones = Admisione::pluck('periodo','id')->toArray();
        return view('admisiones.postulantes.create',compact('modalidad','modalidadTipo','carreras','admisiones','sexos','cliente','searchText'));
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
            //actualizar cliente
            $idCliente = $request->idCliente;
            if ($idCliente == 0){
                //vamos a ingresar nuevo
                $cliente = new Cliente;
                $cliente->dniRuc = $request->dniRuc;
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->telefono = $request->telefono;
                $cliente->telefono2 = $request->telefono2;
                $cliente->email = $request->email;
                $cliente->direccion = $request->direccion;
                $cliente->estado = 1;
                $cliente->save();
            }else{
                //actualizamos
                $cliente = Cliente::findOrfail($idCliente);
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->telefono = $request->telefono;
                $cliente->telefono2 = $request->telefono2;
                $cliente->email = $request->email;
                $cliente->direccion = $request->direccion;
                $cliente->update();
            }
            //vamos a buscar los numeros.
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
            if($request->hasFile('url')){
                $url = Storage::put('fotos', $request->file('url'));
            }
            $postulante = new AdmisionePostulante;
            $postulante->fecha = $request->fecha;
            $postulante->hora = $hora;
            $postulante->expediente = $expediente;
            $postulante->sexo = $request->sexo;
            $postulante->discapacidad = $request->discapacidad;
            $postulante->discapacidadNombre = $request->discapacidadNombre;
            $postulante->modalidadTipo = $request->modalidadTipo;
            $postulante->modalidad = $request->modalidad;
            $postulante->url = $url;
            $postulante->fechaNacimiento = $request->fechaNacimiento;
            $postulante->idCliente = $request->idCliente;
            $postulante->idCarrera = $request->idCarrera;
            $postulante->admisione_id = $request->admisione_id;
            $postulante->colegio_id = $request->colegio_id;
            $postulante->boleta = $request->boleta;
            $postulante->user_id = auth()->user()->id;
            $postulante->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('admisiones/postulantes')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/postulantes')->with('info','se guardo la informacion correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //vamos a imprimir
        $postulante = AdmisionePostulante::findOrFail($id);
        return view('admisiones.postulantes.show',compact('postulante'));
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
        $postulante = AdmisionePostulante::findOrFail($id);
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
            'Titulados'=>'Titulados',
            'Reingresantes'=>'Reingresantes',
            'Traslado Interno'=>'Traslado Interno',
            'Traslado Externo'=>'Traslado Externo'
        ];
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $admisiones = Admisione::pluck('periodo','id')->toArray();
        return view('admisiones.postulantes.edit',compact('postulante','modalidad','modalidadTipo','carreras','admisiones','sexos'));
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
        try {
            //code...
            DB::beginTransaction();
            $idCliente = $request->idCliente;
            //actualizamos cliente
            $cliente = Cliente::findOrfail($idCliente);
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->telefono = $request->telefono;
            $cliente->telefono2 = $request->telefono2;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->update();
            $postulante = AdmisionePostulante::findOrFail($id);
            if($request->hasFile('url')){
                //borro la imagen anterior
                Storage::delete($postulante->url);
                $url = Storage::put('repositorio', $request->file('url'));
                $postulante->url = $url;
            }
            $postulante->sexo = $request->sexo;
            $postulante->discapacidad = $request->discapacidad;
            $postulante->discapacidadNombre = $request->discapacidadNombre;
            $postulante->modalidadTipo = $request->modalidadTipo;
            $postulante->modalidad = $request->modalidad;
            $postulante->fechaNacimiento = $request->fechaNacimiento;
            $postulante->idCarrera = $request->idCarrera;
            $postulante->admisione_id = $request->admisione_id;
            $postulante->colegio_id = $request->colegio_id;
            $postulante->boleta = $request->boleta;
            $postulante->user_id = auth()->user()->id;
            $postulante->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('admisiones/postulantes')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/postulantes')->with('info','se actualizo el postulante correctamente');
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
            $postulante = AdmisionePostulante::findOrFail($id);
            //vamos a borrar la imagen
            Storage::delete($postulante->url);
            $postulante->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('admisiones/postulantes')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/postulantes')->with('info','se elmino la inscripcion correctamente');
    }
    public function anular($id){
        try {
            //code...
            //considerar que si se anula el expediente tambien se debe quitar de los estudiantes tambien
            DB::beginTransaction();
            $postulante = AdmisionePostulante::findOrFail($id);
            //vamos a borrar la imagen
            Storage::delete($postulante->url);
            if($postulante->anulado == "SI"){
                $postulante->anulado = "NO";
            }else{
                $postulante->anulado = "SI";
                //tambien quitar de la tabla de estudiantes
                Estudiante::where('admisione_postulante_id','=',$postulante->id)->delete();
            }
            $postulante->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('admisiones/postulantes')->with('error',$th->getMessage());
        }
        return Redirect::to('admisiones/postulantes')->with('info','se anulo o reactivo la inscripcion correctamente');
    }
}

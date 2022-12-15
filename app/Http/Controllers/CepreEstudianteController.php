<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Cepre;
use App\Models\CepreEstudiante;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PDF;

class CepreEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:cepres.pagos.index')->only('index');
        $this->middleware('can:cepres.pagos.create')->only('create','store');
        $this->middleware('can:cepres.pagos.edit')->only('edit','update');
        $this->middleware('can:cepres.pagos.destroy')->only('destroy');
        $this->middleware('can:cepres.pagos.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $searchText = null;
        if (isset($request->searchText)) {
            # code...
            //ahora que hay código vamos a buscar
            $searchText = $request->searchText;
            $cepreEstudiantes = CepreEstudiante::whereHas('cliente',function($query) use ($searchText){
                $query->where('dniRuc','like','%'.$searchText.'%')->orWhere('apellido','like','%'.$searchText.'%');
            })->get();
        }else{
            $cepreEstudiantes = CepreEstudiante::orderBy('idCepreEstudiante','desc')->get();
        }
        return view('cepres.estudiantes.index',compact('cepreEstudiantes','searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $cliente = BuscarDni('vacio');
        $searchText = null;
        if(isset($request->searchText)){
            //buscar datos del DNI
            $cliente = BuscarDni($request->searchText);
            $searchText = $request->searchText;
        }
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $cepres = Cepre::orderBy('idCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        return view('cepres.estudiantes.create',compact('carreras','cepres','cliente','searchText'));
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
            //verificamos si como esta el id del Cliente
            if($request->hasFile('url')){
                $url = Storage::put('ceprefotos',$request->file('url'));
            }else{
                $url = 'ceprefotos/pordefectoimagen.png';
            }
            $cliente = Cliente::updateOrCreate(['idCliente'=>$request->idCliente],['direccion'=>$request->direccion,'dniRuc'=>$request->dniRuc,'apellido'=>$request->apellido,'nombre'=>$request->nombre,'telefono'=>$request->telefono,'telefono2'=>$request->telefono2,'email'=>$request->email]);
            CepreEstudiante::create([
                'fechaNacimiento'=>$request->fechaNacimiento,
                'url'=>$url,
                'ieProcedencia'=>$request->ieProcedencia,
                'ieDistrito'=>$request->ieDistrito,
                'ieProvincia'=>$request->ieProvincia,
                'ieDepartamento'=>$request->ieDepartamento,
                'ieDireccion'=>$request->ieDireccion,
                'ceEsDepartamento'=>$request->ceEsDepartamento,
                'ceEsProvincia'=>$request->ceEsProvincia,
                'ceEsDistrito'=>$request->ceEsDistrito,
                'ceEsDiscapacidad'=>$request->ceEsDiscapacidad,
                'ceEsObservacion'=>$request->ceEsObservacion,
                'ceEsDisCertificado'=>$request->ceEsDisCertificado,
                'ceEsDisCerObservacion'=>$request->ceEsDisCerObservacion,
                'ceEsFecha'=>$request->ceEsFecha,
                'conNombre'=>$request->conNombre,
                'conApellido'=>$request->conApellido,
                'conTelefono'=>$request->conTelefono,
                'conDireccion'=>$request->conDireccion,
                'conParentesco'=>$request->conParentesco,
                'idCepre'=>$request->idCepre,
                'idCliente'=>$cliente->idCliente,
                'idCarrera'=>$request->idCarrera,
                'id'=>$request->id,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/estudiantes')->with('error','no se matriculo al estudiantes correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('cepres/estudiantes')->with('info','se matriculo al estudiantes correctamente');
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
        $cepreEstudiante = CepreEstudiante::findOrFail($id);
        return view('cepres.estudiantes.show',compact('cepreEstudiante'));
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
        $carreras = Carrera::pluck('nombreCarrera','idCarrera')->toArray();
        $cepres = Cepre::orderBy('idCepre','desc')->pluck('periodoCepre','idCepre')->toArray();
        $cepreEstudiante = CepreEstudiante::findOrFail($id);
        return view('cepres.estudiantes.edit',compact('cepreEstudiante','carreras','cepres'));
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
            
            Cliente::updateOrCreate(['idCliente'=>$request->idCliente],['direccion'=>$request->direccion,'dniRuc'=>$request->dniRuc,'apellido'=>$request->apellido,'nombre'=>$request->nombre,'telefono'=>$request->telefono,'telefono2'=>$request->telefono2,'email'=>$request->email]);
            $cepreEstudiante = CepreEstudiante::findOrFail($id);
            if ($request->hasFile('url')){
                $url = Storage::put('ceprefotos',$request->file('url'));
                $cepreEstudiante->update($request->except('url','D_NIV_MOD','COD_MOD','colegio_id','txt_codigo','idCliente','direccion','dniRuc','apellido','nombre','telefono','telefono2','email'));
                $cepreEstudiante->url = $url;
                $cepreEstudiante->save();
            }else{
                $cepreEstudiante->update($request->except('D_NIV_MOD','COD_MOD','colegio_id','txt_codigo','idCliente','direccion','dniRuc','apellido','nombre','telefono','telefono2','email','url'));
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/estudiantes')->with('error','no se actualizo la matricula del estudiantes correctamente, error: '.$th->getMessage());
        }
        return Redirect::to('cepres/estudiantes')->with('info','se actualizo la matricula del estudiantes correctamente');        
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
            $cepreEstudiante = CepreEstudiante::findOrFail($id);
            $cepreEstudiante->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('cepres/estudiantes')->with('error','no se elimino la matricula del estudiantes correctamente, error: '.$th->getMessage());
        }      
        return Redirect::to('cepres/estudiantes')->with('info','se elimino la matricula del estudiantes correctamente');
    }
}

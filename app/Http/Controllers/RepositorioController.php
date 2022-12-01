<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Documentotipo;
use App\Models\Repositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RepositorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:repositorios.index')->only('index');
        $this->middleware('can:repositorios.create')->only('create','store');
        $this->middleware('can:repositorios.edit')->only('edit','update');
        $this->middleware('can:repositorios.destroy')->only('destroy');
        $this->middleware('can:repositorios.show')->only('show');
    } 
    public function index()
    {
        //
        $repositorios = Repositorio::all();
        return view('repositorios.index',compact('repositorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $searchText = $request->get('searchText');
        if (isset($searchText)){
            $searchText = BuscarDni($searchText);
        }
        $documentotipos = Documentotipo::orderBy('nombre','asc')->pluck('nombre','id')->toArray();
        return view('repositorios.create',compact('documentotipos','searchText'));
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
            //ingresar el documento
            if($request->hasFile('url')){
                $pdf = Storage::put('repositorio', $request->file('url'));
                $repositorio = new Repositorio;
                $repositorio->fecha = $request->fecha;
                $repositorio->asunto = $request->asunto;
                $repositorio->numero = $request->numero;
                $repositorio->url = $pdf;
                $repositorio->documentotipo_id = $request->documentotipo_id;
                $repositorio->user_id = auth()->user()->id;
                $repositorio->idCliente = $request->idCliente;
                $repositorio->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('repositorios')->with('error','nose guardo el documento correctamente: error '.$th->getMessage());
        }
        return Redirect::to('repositorios')->with('info','se guardo el documento correctamente');
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
        $documentotipos = Documentotipo::orderBy('nombre','asc')->pluck('nombre','id')->toArray();
        $repositorio = Repositorio::findOrFail($id);
        return view('repositorios.edit',compact('repositorio','documentotipos'));
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
            if($request->hasFile('url')){
                $repositorio = Repositorio::findOrFail($id);
                //vamos a borrar el arribo anterior
                Storage::delete($repositorio->url);
                //ahora ingresamos el nuevo
                $pdf = Storage::put('repositorio', $request->file('url'));
                $repositorio->fecha = $request->fecha;
                $repositorio->asunto = $request->asunto;
                $repositorio->numero = $request->numero;
                $repositorio->url = $pdf;
                $repositorio->documentotipo_id = $request->documentotipo_id;
                $repositorio->user_id = auth()->user()->id;
                $repositorio->idCliente = $idCliente;
                $repositorio->update();
            }else{
                $repositorio = Repositorio::findOrFail($id);
                $repositorio->fecha = $request->fecha;
                $repositorio->asunto = $request->asunto;
                $repositorio->numero = $request->numero;
                $repositorio->documentotipo_id = $request->documentotipo_id;
                $repositorio->user_id = auth()->user()->id;
                $repositorio->idCliente = $idCliente;
                $repositorio->update();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('repositorios')->with('error',$th->getMessage());
        }
        return Redirect::to('repositorios')->with('info','se actualizo correctamente el documento en el repositorio');
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
            $repositorio = Repositorio::findOrFail($id);
            Storage::delete($repositorio->url);
            //vamos a borrar la imagen
            $repositorio->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::to('repositorios')->with('error',$th->getMessage());
        }
        return Redirect::to('repositorios')->with('info','se elimino correctamente el documento del repositorio');
    }
}

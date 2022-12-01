<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.clientes.index')->only('index');
        $this->middleware('can:ventas.clientes.create')->only('create','store');
        $this->middleware('can:ventas.clientes.edit')->only('edit','update');
        $this->middleware('can:ventas.clientes.destroy')->only('destroy');
        $this->middleware('can:ventas.clientes.show')->only('show');
    }
    public function index(Request $request)
    {
    if ($request){
        $query=trim($request->get('searchText'));
        $clientes=DB::table('clientes')
        ->where('dniruc','LIKE','%'.$query.'%')
        ->orWhere('nombre','LIKE','%'.$query.'%')
        ->orWhere('apellido','LIKE','%'.$query.'%')
        ->orderBy('idCliente','desc')
        ->paginate(25);
        return view('ventas.clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query=trim($request->get('searchText'));
        $dnii=NULL;
        $nombress=NULL;
        $apellidoss=NULL;
        $direccionn=NULL;
        if ($query != NULL & strlen($query)==8)
        {
            $cons = file_get_contents('https://dniruc.apisperu.com/api/v1/dni/'.$query.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImR3YXBhcmljaWNpb0BnbWFpbC5jb20ifQ.2AdhICiTyw6lpnrxtfK2ajSgfMGiMn-71RvrRGKd8Uk');
            $consulta=json_decode($cons,true);
            $dnii=$consulta['dni'];
            $nombress=$consulta['nombres'];
            $apellidoss=$consulta['apellidoPaterno'].' '.$consulta['apellidoMaterno'];
        }
        if ($query != NULL & strlen($query)==11)
        {
            $cons = file_get_contents('https://dniruc.apisperu.com/api/v1/ruc/'.$query.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImR3YXBhcmljaWNpb0BnbWFpbC5jb20ifQ.2AdhICiTyw6lpnrxtfK2ajSgfMGiMn-71RvrRGKd8Uk');
            $consulta=json_decode($cons,true);
            $dnii=$consulta['ruc'];
            $nombress=$consulta['razonSocial'];
            $apellidoss=$consulta['nombreComercial'];
            $direccionn=$consulta['direccion'].' - '.$consulta['distrito'].' - '.$consulta['provincia'].' - '.$consulta['departamento'];
        }
        return view("ventas.clientes.create",["searchText"=>$query,"dnii"=>$dnii,"nombress"=>$nombress,"apellidoss"=>$apellidoss,"direccionn"=>$direccionn]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = new Cliente;
            $cliente->dniRuc=trim($request->get('dniRuc'));
            $cliente->nombre=trim($request->get('nombre'));
            $cliente->apellido=trim($request->get('apellido'));
            $cliente->direccion=$request->get('direccion');
            $cliente->email=$request->get('email');
            $cliente->telefono=$request->get('telefono');
            $cliente->telefono2=$request->get('telefono2');
            $cliente->estado='1';
            $cliente->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('ventas/clientes')->with('error','no se puedo ingresar el cliente correctamente error: '.$th->getMessage());
        }
        return Redirect::to('ventas/clientes')->with('info','se guardo la informacion correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("ventas.clientes.edit",["cliente"=>Cliente::findOrFail($id)]);
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
            $cliente = Cliente::findOrFail($id);
            $cliente->dniRuc=trim($request->get('dniRuc'));
            $cliente->nombre=trim($request->get('nombre'));
            $cliente->apellido=trim($request->get('apellido'));
            $cliente->direccion=$request->get('direccion');
            $cliente->email=$request->get('email');
            $cliente->telefono=$request->get('telefono');
            $cliente->telefono2=$request->get('telefono2');
            $cliente->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('ventas/clientes')->with('error','no se puedo actualizar el cliente, error: '.$th->getMessage());    
        }
        return Redirect::to('ventas/clientes')->with('info','se actualizo correctamente los datos del cliente');
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
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('ventas/clientes')->with('error','no se elimino el cliente correctamente error: '.$th->getMessage());    
        }
        return Redirect::to('ventas/clientes')->with('info','el cliente se elimino correctamente');
    }
}

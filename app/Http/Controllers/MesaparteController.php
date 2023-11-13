<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Dmove;
use App\Models\Document;
use App\Models\Servicio;
use App\Models\Stramite;
use App\Models\Tdocument;
use App\Models\Tmove;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MesaparteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:tdocumentario.mesapartes.index')->only('index');
        $this->middleware('can:tdocumentario.mesapartes.create')->only('create','store');
        $this->middleware('can:tdocumentario.mesapartes.edit')->only('edit','update');
        $this->middleware('can:tdocumentario.mesapartes.destroy')->only('destroy');
        $this->middleware('can:tdocumentario.mesapartes.show')->only('show');
    }
    public function index(Request $request)
    {
        //
        $servicios = Servicio::orderBy('nombre','asc')->get();
        $usuarios = User::where('visibility_tramite','=',true)->pluck('name','id')->toArray();
        $documentos = Document::orderBy('anio','desc')
        ->orderBy('numero','desc')
        ->paginate(10);
        if($request->buscar == 'si'){
            if($request->servicios == 0){
                $documentos = Document::whereBetween('fecha',[$request->finicio,$request->ffin])
                ->Where('asunto','like','%'.$request->asunto.'%')
                ->Where('numero','like','%'.$request->numero.'%')
                ->whereHas('cliente',function($query) use($request){
                    $query->where('dniRuc','like','%'.$request->dniRuc.'%');
                })->get();
            }else{
                $documentos = Document::whereBetween('fecha',[$request->finicio,$request->ffin])
                ->Where('asunto','like','%'.$request->asunto.'%')
                ->Where('numero','like','%'.$request->numero.'%')
                ->where('servicio_id','=',$request->servicios)
                ->whereHas('cliente',function($query) use($request){
                    $query->where('dniRuc','like','%'.$request->dniRuc.'%');
                })->get();
            }
        }
        return view('tdocumentario.mesapartes.index',compact('documentos','usuarios','request','servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $stramites = Servicio::orderBy('nombre','asc')->pluck('nombre','idServicio')->toArray();

        $clientes = Cliente::orderBy('apellido','desc')
        ->selectRaw('concat_ws(", ",dniRuc,apellido,nombre) as apellidos, idCliente')
        ->pluck('apellidos','idCliente')->toArray();
        $tdocuments = Tdocument::pluck('nombre','id')->toArray();
        if(isset($request->searchText)){
            $searchText = $request->searchText;
            $cliente = getdni($searchText);
            return view('tdocumentario.mesapartes.create',compact('stramites','tdocuments','searchText','cliente','clientes'));
        }
        if (isset($request->idCliente)){
            $cli = Cliente::findOrFail($request->idCliente);
            $cliente = BuscarDni($cli->dniRuc);
            $searchText = $cli->dniRuc;
            return view('tdocumentario.mesapartes.create',compact('stramites','tdocuments','searchText','cliente','clientes'));
        }
        return view('tdocumentario.mesapartes.create',compact('clientes'));
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
            //vamos a hacer update del cliente
            if($request->idCliente == 0){
                //vamos a agregar el usuario
                $cliente = new Cliente;
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->dniRuc = $request->dniRuc;
                $cliente->direccion = $request->direccion;
                $cliente->email = $request->email;
                $cliente->telefono = $request->telefono;
                //$cliente->telefono2 = $request->telefono2;
                $cliente->save();
            }else{
                $cliente = Cliente::findOrFail($request->idCliente);
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->dniRuc = $request->dniRuc;
                $cliente->direccion = $request->direccion;
                $cliente->email = $request->email;
                $cliente->telefono = $request->telefono;
                //$cliente->telefono2 = $request->telefono2;
                $cliente->update();
            }
            $anio = Carbon::now()->year;
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $ultimo = Document::where('anio','=',$anio)
            ->orderBy('numero','desc')
            ->first();
            $numero = 0;
            if(isset($ultimo->id)){
                $numero = $ultimo->numero;
                $numero ++;
            }else{
                //no hay numero
                $numero ++;
            }
            //vamos a guardar los datos en la tabla
            $document = new Document;
            $document->numero = $numero;
            $document->fecha = $request->fecha;
            $document->hora = $hora;
            $document->folios = $request->folios;
            $document->asunto = $request->asunto;
            $document->dnumero = $request->dnumero;
            $document->observacion = $request->observacion;
            $document->cliente_id = $cliente->idCliente;
            $document->tdocument_id = $request->tdocument_id;
            $document->anio = $anio;
            if($request->nboleta != null){
                $document->boleta = $request->nboleta;
            }
            $document->telefono = $request->telefono2;
            $document->servicio_id = $request->tramite;
            $document->user_id = auth()->id();
            $document->responsable_id = Auth::user()->oficina->responsable->id;
            $document->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/mesapartes')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/mesapartes')->with('info','se guardo el documento correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $documento = Document::findOrFail($id);
            $documento->numero = $request->numero;
            $documento->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/mesapartes')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/mesapartes')->with('info','se cambio el numero correctamente');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id){
        try {
            $documento = Document::findOrFail($id);
            $tdocuments = Tdocument::pluck('nombre','id')->toArray();
            $stramites = Servicio::orderBy('nombre','asc')->pluck('nombre','idServicio')->toArray();
            return view('tdocumentario.mesapartes.edit',compact('documento','stramites','tdocuments'));
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('tdocumentario.mesapartes.index')->with('error','no se pudo editar el documento correctamente');
        }
        return ($id);
    }
    public function actualizar(Request $request,$id){
        try {
            //code...
            DB::beginTransaction();
            //vamos a hacer update del cliente
            $document = Document::findOrFail($id);
            $cliente = Cliente::findOrFail($document->cliente->idCliente);
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->direccion = $request->direccion;
            $cliente->email = $request->email;
            $cliente->telefono = $request->telefono;
            $cliente->update();
         
            $anio = Carbon::now()->year;
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $ultimo = Document::where('anio','=',$anio)
            ->orderBy('numero','desc')
            ->first();
            $numero = 0;
            if(isset($ultimo->id)){
                $numero = $ultimo->numero;
                $numero ++;
            }else{
                //no hay numero
                $numero ++;
            }
            //vamos a guardar los datos en la tabla
            $document->folios = $request->folios;
            $document->asunto = $request->asunto;
            $document->dnumero = $request->dnumero;
            $document->observacion = $request->observacion;
            $document->tdocument_id = $request->tdocument_id;
            $document->anio = $anio;
            if($request->nboleta != null){
                $document->boleta = $request->nboleta;
            }
            $document->telefono = $request->telefono2;
            $document->servicio_id = $request->tramite;
            $document->user_id = auth()->id();
            $document->responsable_id = Auth::user()->oficina->responsable->id;
            $document->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/mesapartes')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/mesapartes')->with('info','se guardo el documento correctamente');
    }
    public function update(Request $request, $id)
    {
        //
        //listo ahora hay q registrar el movimiento en la tabla de movimientos
        try {
            //code...
            DB::beginTransaction();
                $tmove = Tmove::where('nombre','=','Enviado')->first();
                $fecha = date('Y-m-d',strtotime(Carbon::now()));
                $hora = date('H:i:s',strtotime(Carbon::now()));
                $documento = Document::findorFail($id);
                $documento->enviado = "SI";
                $documento->update();
                $movimiento = new Dmove;
                $movimiento->fecha = $fecha;
                $movimiento->hora = $hora;
                $movimiento->folios = $request->folios;
                $movimiento->observacion = $request->observacion;
                $movimiento->envia_id = auth()->id();
                //como es el movimiento de mesa de partes entonces es desde la oficina de mesa de partes y hay que registrar
                $userEnvia = User::findOrFail(auth()->id());
                if($userEnvia->hasRole('Oficina')){
                    //en etonces el usuario que envia pertenece a una ofcina
                    $movimiento->enviaresponsable_id = $userEnvia->oficina->responsable->id;
                }else{
                    $movimiento->enviaresponsable_id = auth()->id();
                }
                $movimiento->recive_id = $request->user_id;
                //ahora revizamos si al que enviamos es una oficina o un usuario
                $userRecive = User::findOrFail($request->user_id);
                if($userRecive->hasRole('Oficina')){
                    //en etonces el usuario que envia pertenece a una ofcina
                    $movimiento->reciveresponsable_id = $userRecive->oficina->responsable->id;
                }else{
                    $movimiento->reciveresponsable_id = $request->user_id;
                }
                $movimiento->tmove_id = $tmove->id;
                $movimiento->document_id = $id;
                $movimiento->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/mesapartes')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/mesapartes')->with('info','se envio el documento correctamente');
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
            $documento = Document::findOrFail($id);
            $documento->delete();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/mesapartes')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/mesapartes')->with('info','elimino el documento correctamente');
    }
}

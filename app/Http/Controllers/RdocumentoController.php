<?php

namespace App\Http\Controllers;

use App\Models\Dmove;
use App\Models\Document;
use App\Models\Tmove;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RdocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* tdocumentario.mesapartes */
    }
    public function index()
    {
        $usuarios = User::where('visibility_tramite','=',true)->pluck('name','id')->toArray();
        $tmove = Tmove::where('nombre','=','Enviado')->first();
        $recibidos = Dmove::where('recive_id','=',auth()->id())
        ->where('tmove_id','=',$tmove->id)
        ->orderBy('fecha','desc')
        ->orderBy('hora','desc')
        ->get();
        return view('tdocumentario.recibidos.index',compact('recibidos','usuarios'));
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
    public function edit(Request $request,$id)
    {
        //aca finalizamos el documento;
        try {
            //code...
            DB::beginTransaction();
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $movimiento = Dmove::findOrFail($id);
            $documento = Document::findOrFail($movimiento->document_id);
            $documento->finalizado = "SI";
            $documento->save();
            //ahora agrego lo que esta finalizado
            $tmove = Tmove::where('nombre','=','Finalizado')->first();
            $finalizado = new Dmove;
            $finalizado->fecha = $fecha;
            $finalizado->hora = $hora;
            $finalizado->folios = $request->folios;
            $finalizado->observacion = $request->observacion;
            $finalizado->envia_id = $movimiento->envia_id;
            //como es el movimiento de mesa de partes entonces es desde la oficina de mesa de partes y hay que registrar
            $userEnvia = User::findOrFail($movimiento->envia_id);
            if($userEnvia->hasRole('Oficina')){
                //en etonces el usuario que envia pertenece a una ofcina
                $finalizado->enviaresponsable_id = $userEnvia->oficina->responsable->id;
            }else{
                $finalizado->enviaresponsable_id = $movimiento->envia_id;
            }
            $finalizado->recive_id = $movimiento->recive_id;
            //ahora revizamos si al que enviamos es una oficina o un usuario
            $userRecive = User::findOrFail($movimiento->recive_id);
            if($userRecive->hasRole('Oficina')){
                //en etonces el usuario que envia pertenece a una ofcina
                $finalizado->reciveresponsable_id = $userRecive->oficina->responsable->id;
            }else{
                $finalizado->reciveresponsable_id = $movimiento->recive_id;
            }

            $finalizado->tmove_id = $tmove->id;
            $finalizado->document_id = $documento->id;
            $finalizado->save();

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/rdocumentos')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/rdocumentos')->with('info','se finalizo el documento correctamente');
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
        //entonces vamos a registrar el envio del documento
        try {
            //code...
            DB::beginTransaction();
            $dmovimiento = Dmove::findOrFail($id);
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $tmove = Tmove::where('nombre','=','Enviado')->first();
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
            $movimiento->document_id = $dmovimiento->document_id;
            $movimiento->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/rdocumentos')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/rdocumentos')->with('info','se registro el documento correctamente');
        
    }
    public function recepcion($id){
        try {
            //code...
            DB::beginTransaction();
            $dmovimiento = Dmove::findOrFail($id);
            $fecha = date('Y-m-d',strtotime(Carbon::now()));
            $hora = date('H:i:s',strtotime(Carbon::now()));
            $dmovimiento->rfecha = $fecha;
            $dmovimiento->rhora = $hora;
            $dmovimiento->revisado = 'SI';
            $dmovimiento->update();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::to('tdocumentario/rdocumentos')->with('error',$th->getMessage());
        }
        return Redirect::to('tdocumentario/rdocumentos')->with('info','se recepciono el documento');
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

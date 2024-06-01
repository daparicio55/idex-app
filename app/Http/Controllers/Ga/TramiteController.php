<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Catalogo;
use App\Models\Gadministrativa\Requerimiento;
use App\Models\Gadministrativa\Tramite;
use App\Models\Gadministrativa\TramiteDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        
        $tramites = Tramite::orderBy('numero','desc')->get();
        return view('gadministrativa.administracion.tramites.index',compact('tramites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $res = Requerimiento::where('estado','=','Tramitado')
        ->orderBy('numero','desc')
        ->get();
        $requerimientos = [];
        foreach ($res as $key => $re) {
            #verificamos si el requerimiento tiene tramites o no
            if($re->tramites->count() == 0){
                $requerimientos [] = [
                    'id'=>$re->id,
                    'nombre'=>ceros($re->numero).' - '.$re->encabezado.' - '.$re->encabezado.' - '.$re->asunto,
                ];
            }else{
                //ahora verificamos si estos tramites estan todos listos
                foreach ($re->re_detalles as $de) {
                    $ingresa = false;
                    # code...
                    #a esto se debe llegar:
                    $cantidad = $de->cantidad;
                    $contador = 0;
                    foreach($de->tdetalles as $de){
                        $contador += $de->cantidad;
                    }
                    if($contador < $cantidad){
                        $ingresa = true;
                    }
                    if($ingresa){
                        $requerimientos [] = [
                            'id'=>$re->id,
                            'nombre'=>ceros($re->numero).' - '.$re->encabezado.' - '.$re->encabezado.' - '.$re->asunto,
                        ];
                    }
                }
                  
            }
        }
        
        //return $requerimientos;
        $catalogos = Catalogo::orderBy('modelo','asc')
        ->orderBy('descripcion')
        ->get();
        return view('gadministrativa.administracion.tramites.create',compact('requerimientos','catalogos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //return $request;
        try {
            //code...
            DB::beginTransaction();
            $numero = 1;
            $last_tramite = Tramite::orderBy('numero','desc')->first();
            if(isset($last_tramite->numero)){
                $numero = $last_tramite->numero + 1;
            }
            $tramite = new Tramite();
            $tramite->numero = $numero;
            $tramite->requerimiento_id = $request->requerimiento;
            $tramite->user_id = auth()->id();
            $tramite->fecha = Carbon::now();
            $tramite->save();
            //agregamos los detalles
            for ($i=0; $i < count($request->elementos); $i++) { 
                $detalle = new TramiteDetalle();
                $detalle->cantidad = $request->cantidades[$i];
                $detalle->destino =$request->destinos[$i];
                $detalle->tramite_id = $tramite->id;
                //separamos los ids del requerimientoDetalle y el cataloID
                $ids = explode(':',$request->elementos[$i]);
                $detalle->rdetalle_id = $ids[0];
                $detalle->catalogo_id = $ids[1];
                $detalle->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd ($th->getMessage());
            return Redirect::route('gadministrativa.administracion.tramites.index')->with('error','no se registro el tramite del requerimiento');
        }
        return Redirect::route('gadministrativa.administracion.tramites.index')->with('info','se registro el tramite del requerimiento correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $tramite = Tramite::findOrFail($id);
            $requerimiento = Requerimiento::findOrFail($tramite->requerimiento_id);
            $requerimiento->estado = 'Espera';
            $requerimiento->update();
            $tramite->delete();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return Redirect::route('gadministrativa.administracion.tramites.index')->with('error','no se pudo eliminar el tramite');
        }
        return Redirect::route('gadministrativa.administracion.tramites.index')->with('info','se elimino el tramite correctamente');
    }
    public function getTramite($id){
        try {
            //code...
            $arr = [];
            //traigo el trámite
            $tramite = Tramite::findOrFail($id);
            $arr_detalles = [];
            foreach ($tramite->tramiteDetalles as $key => $detalle) {
                # tengo que verificar si este detalle ya esta cargado
                $arr_detalles [] =[
                    'id'=>$detalle->id,
                    'catalogo_id'=>$detalle->catalogo_id,
                    'cantidad'=>$detalle->cantidad,
                    'catalogo'=>$detalle->catalogo->codigo .' - '.$detalle->Catalogo->marca->nombre.' - '.$detalle->catalogo->modelo.' - '.$detalle->catalogo->descripcion .' - x '.$detalle->catalogo->unidade->nombre,
                ];
            }
            $arr = [
                'id'=>$tramite->id,
                'fecha'=>$tramite->fecha,
                'numero'=>$tramite->numero,
                'requerimiento_id'=>$tramite->requerimiento_id,
                'user_id'=>$tramite->user_id,
                'detalles'=>$arr_detalles,
            ];
            return $arr;   
        } catch (\Throwable $th) {
            //throw $th;
            $ar = [
                'message'=>$th->getMessage(),
            ];
            return $ar;
        }        
    }
}

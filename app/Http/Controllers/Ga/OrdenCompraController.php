<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Gadministrativa\Ocompra;
use App\Models\Gadministrativa\OcPrecio;
use App\Models\Gadministrativa\TdCambio;
use App\Models\Gadministrativa\Tramite;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrdenCompraController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $ocompras = Ocompra::orderBy('numero','desc')->get();
        return view('gadministrativa.abastecimiento.ocompras.index',compact('ocompras'));
    }
    public function create(){
        $tramites = Tramite::whereHas('tramiteDetalles',function($query){
            $query->where('destino','Abastecimiento');
        })->orderBy('numero','desc')->get();
        $empresas = Empresa::orderBy('razonSocial','asc')->get();
        return view('gadministrativa.abastecimiento.ocompras.create',compact('tramites','empresas'));
    }
    public function store(Request $request){
        //return $request;
        try {
            //code...
            DB::beginTransaction();
            $orden = new Ocompra();
            $orden->numero = $orden->newNumber();
            $orden->fecha = $request->fecha;
            $orden->dias = $request->dias;
            $orden->user_id = auth()->id();
            $orden->tramite_id = $request->tramites;
            $orden->empresa_id = $request->empresa;
            $orden->save();
            //vamos a poner los precios:
            for ($i=0; $i < count($request->ids); $i++) { 
                # code...
                $precio = OcPrecio::updateOrCreate(
                    [
                        'tdetalle_id'=>$request->ids[$i]
                    ],
                    [
                        'valor'=>$request->precios[$i]
                    ]
                );
                //borramos los precios
                TdCambio::where('tdetalle_id',$request->ids[$i])->delete();
            }
            //aca debe de ir los cambios de catalogo:
            if(isset($request->cambios)){
                for ($i=0; $i < count($request->cambios); $i++) { 
                    # code...
                    $dato = explode(":",$request->cambios[$i]);
                    $cambio = new TdCambio();
                    $cambio->tdetalle_id = $dato[0];
                    $cambio->catalogo_id = $dato[1];
                    $cambio->user_id = auth()->id();
                    $cambio->save();
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('gadministrativa.abastecimiento.ocompras.index')->with('error','no se guardo correctamente la orden de compra');
        }
        return Redirect::route('gadministrativa.abastecimiento.ocompras.index')->with('info','se guardo la orden de compra correctamente');
    }
    public function show($id){
        try {
            //code...
            $ocompra = Ocompra::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.abastecimiento.ocompras.index')->with('error','no se puede mostrar la orden de compra');
        }
        $pdf = PDF::loadview("gadministrativa.abastecimiento.ocompras.show",compact('ocompra'));
		//return $pdf->download('ORDEN-COMPRA-'.ceros($ocompra->numero).'.pdf');
        return view('gadministrativa.abastecimiento.ocompras.show',compact('ocompra'));
    }
    public function destroy($id){
        try {
            //code...
            $orden = Ocompra::findOrFail($id);
            $orden->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.abastecimiento.ocompras.index')->with('error','no se elimino la orden de compra');
        }
        return Redirect::route('gadministrativa.abastecimiento.ocompras.index')->with('info','se elimino la orden de compra correctamente');
    }
    public function getOcompra($id){
        try {
            //code...
            $a_ocompra = [];
            $a_tdetalle = [];
            $ocompra = Ocompra::findOrFail($id);
            //productos de la orden de compra;

            //return $ocompra->tramite->tramiteDetalles;
            foreach ($ocompra->tramite->tramiteDetalles as $tramitedetalle) {
                # code...
                $a_cambio = null;
                if(isset($tramitedetalle->cambio)){
                    $a_cambio = [
                        'catalogo'=>$tramitedetalle->cambio->catalogo->codigo.' '.$tramitedetalle->cambio->catalogo->modeo.' '.$tramitedetalle->cambio->catalogo->descripcion.' - '.$tramitedetalle->cambio->catalogo->marca->nombre,
                        'serie'=>$tramitedetalle->cambio->catalogo->serie,
                        'perecible'=>$tramitedetalle->cambio->catalogo->perecible, 
                    ];
                }
                $a_tdetalle[] = [
                    'id'=>$tramitedetalle->id,
                    'catalogo'=>$tramitedetalle->catalogo->codigo.' '. $tramitedetalle->catalogo->modelo.' '.$tramitedetalle->catalogo->descripcion.' - '.$tramitedetalle->catalogo->marca->nombre,
                    'serie'=>$tramitedetalle->catalogo->serie,
                    'perecible'=>$tramitedetalle->catalogo->perecible,                    
                    'destino'=>$tramitedetalle->destino,
                    'cambio'=>$a_cambio,
                    'cantidad'=>$tramitedetalle->cantidad
                ];
            }


            $a_ocompra = [
                'id'=>$ocompra->id,
                'numero'=>$ocompra->numero,
                'user_id'=>$ocompra->user->id,
                'user'=>$ocompra->user->name,
                'dias'=>$ocompra->dias,
                'fecha'=>$ocompra->fecha,
                'empresa_id'=>$ocompra->empresa->idEmpresa,
                'empresa'=>$ocompra->empresa->razonSocial,
                'detalles'=>$a_tdetalle
            ];
            return $a_ocompra;
        } catch (\Throwable $th) {
            //throw $th;
            $arr = [
                'message'=>$th->getMessage(),
                'id'=>$id,
            ];
            return $arr;
        }        
    }
}

<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Ocompra;
use App\Models\Gadministrativa\Recepcione;
use App\Models\Gadministrativa\RecepcioneDetalle;
use App\Models\Gadministrativa\Serie;
use App\Models\Gadministrativa\TramiteDetalle;
use App\Models\Gadministrativa\Vencimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class AlmacenRecepcioneController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $recepciones = Recepcione::orderBy('numero','desc')->get();
        return view('gadministrativa.almacen.recepciones.index',compact('recepciones'));
    }
    public function create() : View {
        $ocompras = Ocompra::get();
        return view('gadministrativa.almacen.recepciones.create',compact('ocompras'));
    }
    public function destroy($id){
        try {
            //code...
            $recepcion = Recepcione::findOrFail($id);
            $recepcion->delete();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return Redirect::route('gadministrativa.almacen.recepciones.index')->with('error','Error al eliminar la recepción');
        }
        return Redirect::route('gadministrativa.almacen.recepciones.index')->with('info','Recepción eliminada correctamente');
    }
    public function store(Request $request){
        try {
            //code...
            /* $a_series =[];
            $a_perecibles = [];

            foreach ($request->check as $value) {
                //revizar si tiene serie o fecha
                $tdetalle = TramiteDetalle::findOrFail($value);
                if($tdetalle->cambio){
                    if($tdetalle->cambio->catalogo->serie){
                        $a_series[] = 'serie'.$value;
                    }
                    if($tdetalle->cambio->catalogo->perecible){
                        $a_perecibles[] = 'perecible'.$value;
                    }
                }else{
                    if($tdetalle->catalogo->serie){
                        $a_series[] = 'serie'.$value;
                    }
                    if($tdetalle->catalogo->perecible){
                        $a_perecibles[] = 'perecible'.$value;
                    }
                }
            } */
            //guardamos la recepcion
            DB::beginTransaction();
            $recepcion = new Recepcione();
            $recepcion->ocompra_id = $request->ocompras;
            $recepcion->numero = $recepcion->newNumber();
            $recepcion->fecha = Carbon::now();
            $recepcion->user_id = auth()->user()->id;
            $recepcion->save();
            //vamos con los detalles
            foreach ($request->check as $valor) {
                # code...
                $redetalle = new RecepcioneDetalle();
                $redetalle->recepcione_id = $recepcion->id;
                $redetalle->tdetalle_id = $valor;
                $redetalle->save();
                $tdetalle = TramiteDetalle::findOrFail($valor);
                if($tdetalle->cambio){
                    if($tdetalle->cambio->catalogo->serie){
                        $series = $request->{'serie'.$valor};
                        foreach($series as $serie){
                            $s = new Serie();
                            $s->valor = $serie;
                            $s->redetalle_id = $redetalle->id;
                            $s->save();
                        }
                    }
                    if($tdetalle->cambio->catalogo->perecible){
                        $perecibles = $request->{'perecible'.$valor};
                        foreach ($perecibles as $perecible) {
                            # code...
                            $v = new Vencimiento();
                            $v->valor = $perecible;
                            $v->redetalle_id = $redetalle->id;
                            $v->save();
                        }
                    }
                }else{
                    if($tdetalle->catalogo->serie){
                        $series = $request->{'serie'.$valor};
                        foreach($series as $serie){
                            $s = new Serie();
                            $s->valor = $serie;
                            $s->redetalle_id = $redetalle->id;
                            $s->save();
                        }
                    }
                    if($tdetalle->catalogo->perecible){
                        $perecibles = $request->{'perecible'.$valor};
                        foreach ($perecibles as $perecible) {
                            # code...
                            $v = new Vencimiento();
                            $v->valor = $perecible;
                            $v->redetalle_id = $redetalle->id;
                            $v->save();
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return Redirect::route('gadministrativa.almacen.recepciones.index')->with('error','Error al registrar la recepción');
        }
        return Redirect::route('gadministrativa.almacen.recepciones.index')->with('success','Recepción registrada correctamente');  
    }
    public function getRecepcione($id){
        $recepcione = [];
        $re = Recepcione::findOrFail($id);
        $detalles = [];
        foreach ($re->redetalles as $redetalle) {
            # code...
            if($redetalle->tdetalle->cambio){
                $catalogo = $redetalle->tdetalle->cambio->catalogo->codigo .' '. $redetalle->tdetalle->cambio->catalogo->modelo .' '.$redetalle->tdetalle->cambio->catalogo->descripcion.' - '.$redetalle->tdetalle->cambio->catalogo->marca->nombre;
            }else{
                $catalogo = $redetalle->tdetalle->catalogo->codigo .' '. $redetalle->tdetalle->catalogo->modelo .' '.$redetalle->tdetalle->catalogo->descripcion.' - '.$redetalle->tdetalle->catalogo->marca->nombre;
            }
            $detalles [] = [
                'id' => $redetalle->id,
                'tdetalle' => $redetalle->id,
                'catalogo' => $catalogo,
            ];
        }
        $recepcione [] = [
            'id' => $re->id,
            'numero' => $re->numero,
            'fecha' => $re->fecha,
            'detalles' => $detalles,
        ];
        //return $detalles;
        
        return $recepcione;
    }
}

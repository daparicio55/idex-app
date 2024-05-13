<?php

namespace App\Http\Controllers\Ga;

use App\Http\Controllers\Controller;
use App\Models\Gadministrativa\Configuration;
use App\Models\Gadministrativa\NacionalCatalogo;
use App\Models\Gadministrativa\ReDetalle;
use App\Models\Gadministrativa\Requerimiento;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequerimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $requerimientos = Requerimiento::where('user_id','=',auth()->id())
        ->orderBy('id','desc')
        ->get();
        return view('gadministrativa.requerimientos.index',compact('requerimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('gadministrativa.requerimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $numero = 1;
            $ultimo = Requerimiento::orderBy('numero','desc')->first();
            if(isset($ultimo->numero)){
                $numero = $ultimo->numero + 1;
            }
            $requerimiento = new Requerimiento();
            $requerimiento->numero = $numero;
            $requerimiento->user_id = auth()->id();
            $requerimiento->encabezado = $request->encabezado;
            $requerimiento->asunto = $request->asunto;
            $requerimiento->justificacion = $request->justificacion;
            $requerimiento->fecha = Carbon::now();
            $requerimiento->save();
            //guardamos los detalles
            for ($i=0; $i < count($request->ids); $i++) { 
                # code...
                $detalle = new ReDetalle();
                $detalle->requerimiento_id = $requerimiento->id;
                $detalle->ncatalogo_id = $request->ids[$i];
                $detalle->cantidad = $request->cantidades[$i];
                $detalle->observacion = $request->observaciones[$i];
                $detalle->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('gadministrativa.requerimientos.index')->with('error','error guardando el requerimiento');
        }
        return Redirect::route('gadministrativa.requerimientos.index')->with('info','se guardo el requerimiento correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            if($requerimiento->user_id != auth()->id()){
                return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes imprimir este requerimiento');
            }
            $config = Configuration::orderBy('id','desc')->first();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes imprimir este requerimiento');
        }

        
        $pdf = PDF::loadView('gadministrativa.requerimientos.show', compact('requerimiento','config'));
        return $pdf->download('INFORME-'.$requerimiento->id.'.pdf');
        return view('gadministrativa.requerimientos.show',compact('requerimiento','config'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            if($requerimiento->user_id != auth()->id()){
                return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes editar este requerimiento');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes editar este requerimiento');
        }
        return view('gadministrativa.requerimientos.edit',compact('requerimiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //return $request;
        try {
            DB::beginTransaction();
            $requerimiento = Requerimiento::findOrFail($id);
            if($requerimiento->user_id != auth()->id()){
                return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes editar este requerimiento');
            }
            $requerimiento->encabezado = $request->encabezado;
            $requerimiento->asunto = $request->asunto;
            $requerimiento->justificacion = $request->justificacion;
            $requerimiento->update();
            //borrar todos los detalles
            ReDetalle::where('requerimiento_id','=',$id)->delete();
            //detalles
            for ($i=0; $i < count($request->ids); $i++) { 
                # code...
                $detalle = new ReDetalle();
                $detalle->requerimiento_id = $requerimiento->id;
                $detalle->ncatalogo_id = $request->ids[$i];
                $detalle->cantidad = $request->cantidades[$i];
                $detalle->observacion = $request->observaciones[$i];
                $detalle->save();
            }
            DB::commit();
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes editar este requerimiento');
        }
        return Redirect::route('gadministrativa.requerimientos.index')->with('info','el requerimiento se edito correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            if($requerimiento->user_id != auth()->id()){
                return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes eliminar este requerimiento');
            }
            $requerimiento->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('gadministrativa.requerimientos.index')->with('error','no puedes eliminar este requerimiento');
        }
        return Redirect::route('gadministrativa.requerimientos.index')->with('info','se elimino el requerimiento correctamente');
    }
    public function buscar(Request $request){
        return $request;
    }

    //metodos para el requerimiento de ADMINISTRACION


    public function archivar($id){
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            $requerimiento->estado = "Archivado";
            $requerimiento->update();
        } catch (\Throwable $th) {
            //throw $th;
            Return Redirect::route('gadministrativa.administracion.requerimientos.index')->with('error','error al archivar');
        }
        Return Redirect::route('gadministrativa.administracion.requerimientos.index')->with('info','se archivo correctamente');
    }
    public function tramitar($id){
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            $requerimiento->estado = "Tramitado";
            $requerimiento->update();
        } catch (\Throwable $th) {
            //throw $th;
            Return Redirect::route('gadministrativa.administracion.requerimientos.index')->with('error','error al tramitar');
        }
        Return Redirect::route('gadministrativa.administracion.requerimientos.index')->with('info','se tramitó correctamente');
    }
    public function index_administracion(){
        $requerimientos = Requerimiento::orderBy('numero')
        ->where('estado','=','Espera')
        ->get();
        return view('gadministrativa.administracion.requerimientos.index',compact('requerimientos'));
    }
    public function getRequerimiento($id){
        $array = [];
        try {
            //code...
            $requerimiento = Requerimiento::findOrFail($id);
            $d = [];
            foreach ($requerimiento->re_detalles as $key => $detalle) {
                # code...
                $d [] = 
                [
                    'id'=>$detalle->id,
                    'cantidad'=>$detalle->cantidad,
                    'denominacion'=>$detalle->ncatalogo->denominacion,
                    'observacion'=>$detalle->observacion,
                ];
            }
            $array = [
                'id'=>$requerimiento->id,
                'numero'=>$requerimiento->numero,
                'asunto'=>$requerimiento->asunto,
                'encabezado'=>$requerimiento->encabezado,
                'estado'=>$requerimiento->tramitado,
                'fecha'=>date('d-m-Y',strtotime($requerimiento->fecha)),
                'justificacion'=>$requerimiento->justificacion,
                'detalles'=>$d,
            ];
            return $array;
        } catch (\Throwable $th) {
            //throw $th;
            $arry = [
                'message'=>$th->getMessage(),
            ];
            return $array;
        }
        /* return $requerimiento->re_detalles[0]->ncatalogo;
        $arry = [
            'message'=>'Esta listo para usar: '.$id
        ];
        return $arry; */
    }
}

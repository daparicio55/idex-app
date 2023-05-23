<?php

namespace App\Http\Controllers;

use App\Exports\VentaExport;
use App\Models\Apertura;
use App\Models\Indicadore;
use App\Models\Pmatricula;
use App\Models\Uasignada;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AperturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.aperturas.index')->only('index');
        $this->middleware('can:ventas.aperturas.create')->only('create','store');
        $this->middleware('can:ventas.aperturas.edit')->only('edit','update');
        $this->middleware('can:ventas.aperturas.destroy')->only('destroy');
        $this->middleware('can:ventas.aperturas.show')->only('show');
    }
    public function index()
    {
        //
        $aperturas = Apertura::get();
        return view('ventas.aperturas.index',compact('aperturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $docentes = User::orderBy('name','asc')->get();
        $periodos = Pmatricula::orderBy('nombre','desc')->get();
        if(isset($request->docente)){
            //dd($request);
            //tenemos que buscar las unidades asignadas
            if ($request->tipo == 1){
                $tipo = "plan";
                $uasignadas = Uasignada::where('user_id',$request->docente)
                ->where('pmatricula_id',$request->pmatricula)
                ->get();
                return view('ventas.aperturas.create',compact('docentes','periodos','uasignadas','tipo'));
            }else{
                //dd("hola");
                $fecha_actual = Carbon::now();
                $tipo = "indicador";
                $indicadores = Indicadore::WhereHas('capacidade.uasignada',function($query)use($request){
                    $query->where('user_id',$request->docente)
                    ->where('pmatricula_id',$request->pmatricula);
                })->where('fecha','<',$fecha_actual)
                ->get();
                return view('ventas.aperturas.create',compact('docentes','periodos','indicadores','tipo'));
            }
            
            /* "docente" => "36"
            "pmatricula" => "68"
            "tipo" => "2" */
        }
        return view('ventas.aperturas.create',compact('docentes','periodos'));
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
            //code...
            //vamos a buscar el numero de venta
            DB::beginTransaction();
            $vent = Venta::where('numero','=',$request->boleta)->first();
            $venta = Venta::findOrFail($vent->idVenta);
            if($request->tipo == "plan"){
                $modelo = "App\Models\Uasignada";
            }else{
                $modelo = "App\Models\Indicadore";
            }
            $now = Carbon::now();
            $apertura = new Apertura;
            $apertura->aperturable_id = $request->uasignada;
            $apertura->aperturable_type = $modelo;
            $apertura->fecha = date('Y-m-d',strtotime($now));
            $apertura->hora = date('H:i:s',strtotime($now));
            $apertura->venta_id = $venta->idVenta;
            $apertura->user_id = auth()->id();
            $apertura->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('ventas.aperturas.index')->with('error','se produjo un error cuando se intento guardar la apertura del plan/indicador');
        }
        return Redirect::route('ventas.aperturas.index')->with('info','se guardo la apertura del plan/indicador');
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
            $apertura = Apertura::findOrFail($id);
            $apertura->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect::route('ventas.aperturas.index')->with('error',$th->getMessage());
        }
        return Redirect::route('ventas.aperturas.index')->with('info','se elimino la apertura correctamente');
    }
}

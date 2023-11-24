<?php

namespace App\Http\Controllers;

use App\Exports\VentaExport;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		
        $this->middleware('auth');
		$this->middleware('can:ventas.ventas.index')->only('index');
        $this->middleware('can:ventas.ventas.create')->only('create','store');
        $this->middleware('can:ventas.ventas.edit')->only('edit','update');
        $this->middleware('can:ventas.ventas.destroy')->only('destroy');
        $this->middleware('can:ventas.ventas.show')->only('show');
		$this->middleware('can:ventas.ventas.anular')->only('anular');
    }
    public function index(Request $request)
    {
		$servicios = Servicio::orderBy('nombre','asc')->get();
		$ventas = Venta::orderBy('fecha','desc')
		->orderBy('numero','desc')
		->paginate(10);
		if(isset($request->buscar)){
			$ventas = Venta::whereBetween('fecha',[$request->finicio,$request->ffin])
			->whereHas('cliente',function($query) use($request){
				if(isset($request->dni)) {
					$query->where('dniRuc','=',$request->dni);
				}
			})
			->whereHas('detalles',function($sql) use($request){
				if(isset($request->servicios)){
					$sql->whereIn('idServicio',$request->servicios);
				}
			})
			->where(function($res) use($request){
				if(isset($request->estado)) {
					if($request->estado == "Activo"){
						$res->where('estado','=','Activo');
					}
					if($request->estado == "Anulado"){
						$res->where('estado','=','Anulado');
					}
				}
			})
			->get();
		}
		return view('ventas.ventas.index',compact('servicios','ventas'));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('ventas.ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			'ids'=>[
				'required',
			],
			'fecha'=>[
				'required',
				'date',
				function($attribute,$value,$fail){
					$fechaActual = date('Y-m-d',strtotime(Carbon::now()));
					$fechaIngresada = Carbon::parse($value);
					if ($fechaIngresada->isBefore($fechaActual)) {
                        $fail('La fecha  debe ser igual o mayor a la fecha actual.');
                    }
				},
			]
		]);
		try {
			DB::beginTransaction();
			//actualizamos el Cliente o lo CREAMOS
			$cliente = Cliente::updateOrCreate(
				[
					'dniRuc'=>$request->dni
				],
				[
					'apellido'=>$request->apellido,
					'nombre'=>$request->nombre,
					'telefono'=>$request->telefono,
					'telefono2'=>$request->telefono2,
					'email'=>$request->email,
					'direccion'=>$request->direccion,
				]
			);
			//ahora agreamos la venta
			$venta = Venta::create(
				[
					'tipo'=>$request->tipo,
					'numero'=>$request->numero,
					'fecha'=>$request->fecha,
					'tipopago'=>$request->tpago,
					'comentario'=>$request->observacion,
					'idCliente'=>$cliente->idCliente,
					'total'=>$request->total,
					'pagado'=>'SI',
					'estado'=>'activo',
				]
			);
			//agregamos los detalles
			for ($i=0; $i < count($request->ids); $i++) { 
				# code...
				$detalle = new VentaDetalle();
				$detalle->cantidad = $request->cantidades[$i];
				$detalle->precio = $request->precios[$i];
				$detalle->idServicio = $request->ids[$i];
				$detalle->idVenta = $venta->idVenta;
				$detalle->save();
			}
			DB::commit();
			return Redirect::route('ventas.ventas.index')->with('info','se guardo la venta correctamente');
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
			dd($th->getMessage());
		}
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
        $ventas=DB::table('ventas as v')
    	->join('clientes as c','c.idCliente','=','v.idCliente')
    	->select('v.idVenta','v.tipo','v.fecha','v.numero','c.nombre','c.apellido','v.total','v.comentario','v.tipoPago')
    	->where ('v.idVenta','=',$id)
    	->first();
    	$detalles=DB::table('ventasdetalles as vd')
    	->join('servicios as ser','vd.idServicio','=','ser.idServicio')
    	->select('vd.idVentasDetalles','vd.cantidad','ser.nombre','vd.precio',DB::raw('vd.cantidad * vd.precio as importe'))
    	->where('vd.idVenta','=',$id)
    	->get();
    	return view("ventas.ventas.show",["ventas"=>$ventas,"detalles"=>$detalles]);
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
        //vamos a editar el numero de boleta
		try {
			//code...
			$venta = Venta::findOrFail($id);
			$venta->numero = $request->numero;
			$venta->update();
		} catch (\Throwable $th) {
			//throw $th;
			return Redirect::to($request->url)->with('error',$th->getMessage());
		}
		return Redirect::to($request->url)->with('info','se cambio el número de boleta correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function anular(Request $request, $id){
		//vamos a ingresar una venta para annular
		//se solo necesito la fecha y el numero de boleta
		//en usuario y el producto se pone desde aca
		try {
			//code...
			DB::beginTransaction();
			$cliente = Cliente::where('nombre','=','anulado')
			->where('apellido','=','anulado')
			->first();
			$servicio = Servicio::where('nombre','=','anulado')
			->first();
			$venta = new Venta;
			$venta->fecha = $request->fecha;
			$venta->tipo = 'Boleta';
			$venta->numero = $request->numero;
			$venta->total = 0;
			$venta->idCliente = $cliente->idCliente;
			$venta->estado = 'anulado';
			$venta->tipoPago = 'Contado';
			$venta->comentario = 'anulado';
			$venta->pagado = 'si';
			$venta->save();
			DB::commit();
		} catch (\Throwable $th) {
			//throw $th;
			DB::rollBack();
			Return Redirect::route('ventas.ventas.index')->with('error','no se pudo guardar la venta anulada, error: '.$th->getMessage());
		}
		return Redirect::route('ventas.ventas.index')->with('info','se guardo la venta anulada correctamente');
	}
    public function destroy($id)
    {
        try {
            $datos = explode(":",$id);
            if ($datos[1]=='anular')
            {
                $venta=Venta::findOrFail($datos[0]);
				if($venta->estado == 'anulado'){
					$venta->estado='activo';	
				}else{
					$venta->estado='anulado';
				}
                $venta->update();
            }
            if ($datos[1]=='eliminar')
            {
				//verificamos si es la ultima venta
                $venta=Venta::findOrFail($datos[0]);
				$ventas = Venta::orderBy('numero','desc')->first();
				if($ventas->idVenta == $venta->idVenta){
					$venta->delete();
				}else{
					return Redirect::route('ventas.ventas.index')->with('error','no se puede eliminar esta venta por que ya esta emitida otro comprobante');
				}
            }
            if ($datos[1]=='editar')
            {
                $venta=Venta::findOrFail($datos[0]);
                return ('editar');
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            
            return Redirect::to('ventas/ventas')->with('error','nose puedo eliminar anular, error: '.$th->getMessage());
        }
        return Redirect::to('ventas/ventas')->with('info','los cambios fueron realizados correctamente');
    }
    public function imprimir($id)
	{
		$ventas=DB::table('ventas as v')
    	->join('clientes as c','c.idCliente','=','v.idCliente')
    	->select('v.comentario','v.idVenta','v.tipo','v.fecha','v.numero','c.nombre','c.apellido','c.direccion','c.dniRuc','v.total')
    	->where ('v.idVenta','=',$id)
    	->first();
    	$detalles=DB::table('ventasdetalles as vd')
    	->join('servicios as ser','vd.idServicio','=','ser.idServicio')
    	->select('vd.idVentasDetalles','vd.cantidad','ser.nombre as descripcion','vd.precio',DB::raw('vd.cantidad * vd.precio as importe'))
    	->where('vd.idVenta','=',$id)
		->get();
		
		$pdf = PDF::loadview("ventas.ventas.imprimirv21",["ventas"=>$ventas,"detalles"=>$detalles]);
		$pdf->setPaper('a5','portrait');
		return $pdf->download('comp'.$ventas->fecha.$ventas->tipo.'-'.$ventas->numero.'.pdf');
	}
	public function excel($id){
		$datos = explode(":",$id);
		if ($datos[1]!=NULL & $datos[2]!=NULL & $datos[3]!=NULL & $datos[4]!=NULL)
		{		
			return Excel::download(new VentaExport($datos),$datos[2].'-'.$datos[3].'.xlsx');
		}
	}
	public function reporte(Request $request){
		dd($request);
	}
	public function imprimirv2($id)
	{

		$datos = explode(":",$id);
		if ($datos[1]!=NULL & $datos[2]!=NULL & $datos[3]!=NULL & $datos[4]!=NULL)
		{
			if ($datos[4]==0)
			{
				$ventas = Venta::whereBetween('fecha',[$datos[2],$datos[3]])
				->orderBy('idVenta','asc')
				->get();
				$sumaTotal=DB::table('ventas as v')
				->join('clientes as c','c.idCliente','=','v.idCliente')
				->join('ventasdetalles as vd','v.idVenta','=','vd.idVenta')
				->select(DB::raw('SUM(v.total) as sumaTotal'))
				->where ('v.estado','=','activo')
				->whereBetween('v.fecha',[$datos[2],$datos[3]])
				->first();
				$servicio = 'todos';
			}
			else
			{
				$ventas = Venta::whereBetween('fecha',[$datos[2],$datos[3]])
				->whereHas('detalles.servicio',function($query) use($datos){
					$query->where('idServicio','=',$datos[4]);
				})->orderBy('idVenta','asc')
				->get();
				$sumaTotal=DB::table('ventas as v')
				->join('clientes as c','c.idCliente','=','v.idCliente')
				->join('ventasdetalles as vd','v.idVenta','=','vd.idVenta')
				->select(DB::raw('SUM(v.total) as sumaTotal'))
				->where('v.estado','=','activo')
				->where('vd.idServicio','=',$datos[4])
				->whereBetween('v.fecha',[$datos[2],$datos[3]])
				->first();
				$serv = DB::table('servicios')
				->where('idServicio','=',$datos[4])
				->first();
				$servicio = $serv->nombre;
			}
			return view("ventas.ventas.imprimirv2",["ventas"=>$ventas,"datos"=>$datos,"sumaTotal"=>$sumaTotal,'servicio'=>$servicio]);
			$pdf = PDF::loadview("ventas.ventas.imprimirv2",["ventas"=>$ventas,"datos"=>$datos,"sumaTotal"=>$sumaTotal,'servicio'=>$servicio]);
			return $pdf->download('REPORT'.$datos[2].'-'.$datos[3].'-'.$datos[1].'.pdf');
		}
		else
		{
			return view('ventas.ventas.errorimprimir');
		}
	}
}

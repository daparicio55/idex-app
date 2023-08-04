<?php

namespace App\Http\Controllers;

use App\Exports\VentaExport;
use App\Models\Cliente;
use App\Models\Estudiante;
use App\Models\Servicio;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        $query=trim($request->get('searchText'));
		$tipoPago=trim($request->get('tipoPago'));
		$fInicio=trim($request->get('dInicio'));
		$fFin=trim($request->get('dFin'));
		$idServicio = trim($request->get('idServicio'));
		$servicios = DB::table('servicios')
		->get();
		if ($fInicio == NULL)
		{
			$ventas=DB::table('ventas as v')
			->join('clientes as c','c.idCliente','=','v.idCliente')
			->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
			->where('estado','=',1)
			->orderBy('v.fecha','desc')
			->orderBy('v.numero','desc')
			->paginate(7);
		}
		else
		{
			if ($tipoPago == 'Todo')
			{
				if ($idServicio == 0)
				{
					if ($query == NULL)
					{
						$ventas=DB::table('ventas as v')
						->join('clientes as c','c.idCliente','=','v.idCliente')
						->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
						->whereBetween('v.fecha',[$fInicio,$fFin])
						->orderBy('v.fecha','desc')
						->orderBy('v.numero','desc')
						->paginate(7);
					}
					else
					{
						if (strlen($query) == 8)
						{
							$ventas=DB::table('ventas as v')
							->join('clientes as c','c.idCliente','=','v.idCliente')
							->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
							->whereBetween('v.fecha',[$fInicio,$fFin])
							->where('c.dniRuc','=',$query)
							->orderBy('v.fecha','desc')
							->orderBy('v.numero','desc')
							->paginate(7);
						}
						else
						{
							$ventas=DB::table('ventas as v')
							->join('clientes as c','c.idCliente','=','v.idCliente')
							->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
							->whereBetween('v.fecha',[$fInicio,$fFin])
							->where('v.numero','=',$query)
							->orderBy('v.fecha','desc')
							->orderBy('v.numero','desc')
							->paginate(7);
						}
					}
				}
				else
				{
					if ($query == NULL)
					{
						$ventas=DB::table('ventas as v')
						->join('clientes as c','c.idCliente','=','v.idCliente')
						->join('ventasdetalles as vd','v.idVenta','=','vd.idVenta')
						->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
						->whereBetween('v.fecha',[$fInicio,$fFin])
						->where('vd.idServicio','=',$idServicio)
						->orderBy('v.fecha','desc')
						->orderBy('v.numero','desc')
						->paginate(7);
					}
					else
					{
						if (strlen($query) == 8)
						{
							$ventas=DB::table('ventas as v')
							->join('clientes as c','c.idCliente','=','v.idCliente')
							->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
							->whereBetween('v.fecha',[$fInicio,$fFin])
							->where('c.dniRuc','=',$query)
							->where('vd.idServicio','=',$idServicio)
							->orderBy('v.fecha','desc')
							->orderBy('v.numero','desc')
							->paginate(7);
						}
						else
						{
							$ventas=DB::table('ventas as v')
							->join('clientes as c','c.idCliente','=','v.idCliente')
							->select('v.idVenta','v.tipo','v.numero','c.nombre','c.dniRuc','c.direccion','c.apellido','v.estado','v.total','v.tipoPago','v.fecha')
							->whereBetween('v.fecha',[$fInicio,$fFin])
							->where('v.numero','=',$query)
							->where('vd.idServicio','=',$idServicio)
							->orderBy('v.fecha','desc')
							->orderBy('v.numero','desc')
							->paginate(7);
						}
					}
				}
			}
		}		
    	return view('ventas.ventas.index',["ventas"=>$ventas,"searchText"=>$query,"dInicio"=>$fInicio,"dFin"=>$fFin,"tipoPago"=>$tipoPago,'servicios'=>$servicios,'idServicio'=>$idServicio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $servicios=DB::table('servicios')
		->where('estado','=','1')
		->get();
		$dni=trim($request->get('dni'));
        $nombre=NULL;
        $apellido=NULL;
        $direccion=NULL;
		$correo=NULL;
		$telefono=NULL;
		$idCliente=0;
		$numero = DB::table('ventas')
		->select('numero')
		->where('tipo','=','Boleta')
		->orderBy('numero','desc')
		->first();
		if ($dni != NULL)
		{
			$cliente = DB::table('clientes')
			->where('dniRuc','=',$dni)
			->first();

			$cantidad = DB::table('clientes')
			->where('dniRuc','=',$dni)
			->count();
			if ($cantidad == 0)
			{
				$cons = file_get_contents('https://dniruc.apisperu.com/api/v1/dni/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImR3YXBhcmljaWNpb0BnbWFpbC5jb20ifQ.2AdhICiTyw6lpnrxtfK2ajSgfMGiMn-71RvrRGKd8Uk');
				$arr = json_decode($cons,false);
				if (isset($arr->success))
				{
					//$dni='INGRESE MANUAL';
					$nombre=NULL;
					$apellido="INGRESE MANUAL";

				}
				else
				{
					if ($cons =='"success":false,"message":"No se encontraron resultados."')
					{
						//$dni='INGRESE MANUAL';
						$nombre=NULL;
						$apellido="INGRESE MANUAL";
					}
					else
					{
						$consulta=json_decode($cons,true);
						$dni=$consulta['dni'];
						$nombre=$consulta['nombres'];
						$apellido=$consulta['apellidoPaterno'].' '.$consulta['apellidoMaterno'];
					}
				}
				$direccion=NULL;
				$correo=NULL;
				$telefono=NULL;
			}
			else
			{
				$idCliente = $cliente->idCliente;
				$apellido = $cliente->apellido;
				$nombre= $cliente->nombre;
				$direccion = $cliente->direccion;
				$correo = $cliente->email;
				$telefono = $cliente->telefono;
			}
		}
		$cliente = Cliente::find($idCliente);
		return view("ventas.ventas.create",["cliente"=>$cliente,"dni"=>$dni,"apellido"=>$apellido,"nombre"=>$nombre,"direccion"=>$direccion,"correo"=>$correo,"telefono"=>$telefono,"idCliente"=>$idCliente,"numero"=>$numero,"servicios"=>$servicios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
    	{
			//verificamos el cliente
			DB::beginTransaction();
			$venta = new Venta;
			if ($request->get('idCliente') == 0)
			{
				//vamos a insertar el cliente nuevo
				$cliente = new Cliente;
				$cliente->dniRuc=$request->get('dniRuc');
				$cliente->nombre=$request->get('nombre');
				$cliente->apellido=$request->get('apellido');
				$cliente->direccion=$request->get('direccion');
				$cliente->email=$request->get('email');
				$cliente->telefono=$request->get('telefono');
				$cliente->estado='1';
				$cliente->save();
				$venta->idCliente=$cliente->idCliente;
			}
			else
			{
				$venta->idCliente=$request->get('idCliente');
			}
            $venta->fecha=$request->get('fecha');
            $venta->tipo=$request->get('tipo');
            $venta->numero=$request->get('numero');
            $venta->total=$request->get('total_venta');
			$venta->estado="activo";
			if ($request->get('tipoPago')=='Credito')
			{
				$venta->tipoPago=$request->get('tipoPago');
				$venta->pagado = 'no';
			}
			else
			{
				$venta->tipoPago=$request->get('tipoPago');
				$venta->pagado = 'si';
			}
			$venta->comentario=$request->get('comentario');
            $venta->save();
            $idServicio=$request->get('idServicio');
            $cantidad=$request->get('cantidad');
			$precio=$request->get('precio');
    		$cont = 0;

    		while ($cont < count($idServicio))
    		{
    			$detalle = new VentaDetalle();
    			$detalle->idVenta=$venta->idVenta;
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio=$precio[$cont];
    			$detalle->idServicio=$idServicio[$cont];
    			$detalle->save();
    			$cont=$cont+1;
    		}
    		DB::commit();
    	}
    	catch(\Throwable $th)
    	{
    		DB::rollback();
            return Redirect::to('ventas/ventas')->with('error','no se pudo guardar la venta, error: '.$th->getMessage());    
    	}
    	return Redirect::to('ventas/ventas')->with('info','la venta se guardo de forma correcta');
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
			return Redirect::to('ventas/ventas')->with('error','no se pudo guardar la venta anulada, error: '.$th->getMessage());
		}
		return Redirect::to('ventas/ventas')->with('info','se guardo la venta anulada correctamente');    
	}
    public function destroy($id)
    {
        try {
            //code...
            DB::beginTransaction();
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
                $venta=Venta::findOrFail($datos[0]);
                $venta->delete();
            }
            if ($datos[1]=='editar')
            {
                $venta=Venta::findOrFail($datos[0]);
                return ('editar');
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
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

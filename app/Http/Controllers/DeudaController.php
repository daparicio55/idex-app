<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Deuda;
use App\Models\DeudaDetalle;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;
class DeudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.deudas.index')->only('index');
        $this->middleware('can:ventas.deudas.create')->only('create','store');
        $this->middleware('can:ventas.deudas.edit')->only('edit','update');
        $this->middleware('can:ventas.deudas.destroy')->only('destroy');
        $this->middleware('can:ventas.deudas.show')->only('show');
    }
    public function index(Request $request)
    {
        $query = $request->get('searchText');
        $estado = $request->get('estado');
        if(isset($request->estado)){
            
            $deudas = Deuda::whereRelation('cliente','dniRuc','like','%'.$query.'%')
            ->where('estado','=',$estado)
            ->orderBy('numero','desc')
            ->get();
        }else{
            $deudas = Deuda::orderBy('numero','desc')->get();
        }
        return view('ventas.deudas.index',['deudas'=>$deudas,'searchText'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
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

				if ($cons == NULL)
				{
					$dni='INGRESE MANUAL';
					$nombre=NULL;
					$apellido=NULL;
				}
				else
				{
					if ($cons='"success":false,"message":"No se encontraron resultados."')
					{
						$dni='INGRESE MANUAL';
						$nombre=NULL;
						$apellido=NULL;
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
        return view('ventas.deudas.create',["dni"=>$dni,"apellido"=>$apellido,"nombre"=>$nombre,"direccion"=>$direccion,"correo"=>$correo,"telefono"=>$telefono,"idCliente"=>$idCliente,"servicios"=>$servicios]);
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
        try
    	{
			//verificamos el cliente
			DB::beginTransaction();
            $deuda = new Deuda;
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
				$deuda->idCliente=$cliente->idCliente;
			}
			else
			{
				$deuda->idCliente=$request->get('idCliente');
			}
            $numero = DB::table('deudas')
            ->select('numero')
            ->orderBy('numero','desc')
            ->first();
            if ($numero == NULL)
            {
                $numero = 1;
            }
            else
            {
                $numero = $numero->numero + 1;
            }
            $servi = explode('_',$request->get('pidservicio'));
            $deuda->idServicio=$servi[0];
            $deuda->fDeuda=$request->get('fecha');
            $deuda->idCarreras=1;
			$deuda->estado="deuda";
            $deuda->observacion=$request->get('observacion');
            $deuda->numero = $numero;
            $deuda->save();
    		$cont = 0;
            $fechas = $request->get('ffecha');
            $montos = $request->get('pMensual');
            $orden = $request->get('orden');
    		while ($cont < count($fechas))
    		{
    			$detalle = new DeudaDetalle();
    			$detalle->idDeuda=$deuda->idDeuda;
                $detalle->fechaPrograma=$fechas[$cont];
                $detalle->monto=$montos[$cont];
                $detalle->orden=$orden[$cont];
    			$detalle->save();
    			$cont=$cont+1;
    		}
    		DB::commit();
    	}
    	catch(\Throwable $th)
    	{
    		DB::rollback();
            return Redirect::to('ventas/deudas')->with('error','error al guardar la deuda, error: '.$th->getMessage());
    	}
    	return Redirect::to('ventas/deudas')->with('info','la deuda se guardo correctamente');
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
        $estudiante = Estudiante::findOrFail($id);
        $deudas = Deuda::where('estado','=','deuda')
        ->where('idCliente','=',$estudiante->postulante->cliente->idCliente)->get();
        $array=[];
        foreach ($deudas as $key => $deuda) {
            # code...
            $deta = [];
            foreach ($deuda->deudadetalles()->orderBy('orden','asc')->get() as $llave => $detalle) {
                # code...
                $deta[] = [
                    'orden'=>$detalle->orden,
                    'fprogramada'=>$detalle->fechaPrograma,
                    'monto'=>$detalle->monto,
                    'estado'=>$detalle->estado,
                    'boleta'=>$detalle->boletaNumero
                ];
            }
            $array[] = [
                'numero'=>$deuda->numero,
                'estado'=>$deuda->estado,
                'observacion'=>$deuda->observacion,
                'servicio'=>$deuda->servicio->nombre,
                'fecha'=>$deuda->fDeuda,
                'detalles'=>$deta,
            ];
        }
        return json_encode($array);
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
    public function destroy(Request $request,$id)
    {
        //
        //FUNCIONES DEL MODAL
      
            //code...
          
            $variable = explode(':',$id);
            if ($variable[1]=='pagar')
            {
                $dede = DeudaDetalle::findOrFail($variable[0]);
                $dede->estado = 'pagado';
                $dede->boletaNumero = $request->get('numeroBoleta');
                $dede->update();
                //verificar todas las cuotas.
                $detalles = DB::table('deudas_detalles')
                ->where('idDeuda','=',$dede->idDeuda)
                ->get();
                $pagado = 'si';
                foreach($detalles as $det){
                    if($det->estado == 'deuda')
                    {
                        $pagado = 'no';
                    }
                }
                if ($pagado == 'si')
                {
                    //vamos a cambiar los datos en la tabla de deudas
                    $deuda = Deuda::findOrFail($dede->idDeuda);
                    $deuda->estado = 'pagado';
                    $deuda->update();
                }
                else
                {
                    $deuda = Deuda::findOrFail($dede->idDeuda);
                    $deuda->estado = 'deuda';
                    $deuda->update();
                }
                return redirect('ventas/deudas/pagar/'.$dede->idDeuda);
            }
            if ($variable[1]=='eliminar')
            {
                $dede = DeudaDetalle::findOrFail($variable[0]);
                $dede->estado = 'deuda';
                $dede->boletaNumero = NULL;
                $dede->update();
                //verificar todas las cuotas.
                $detalles = DB::table('deudas_detalles')
                ->where('idDeuda','=',$dede->idDeuda)
                ->get();
                $pagado = 'si';
                foreach($detalles as $det){
                    if($det->estado == 'deuda')
                    {
                        $pagado = 'no';
                    }
                }
                if ($pagado == 'si')
                {
                    //vamos a cambiar los datos en la tabla de deudas
                    $deuda = Deuda::findOrFail($dede->idDeuda);
                    $deuda->estado = 'pagado';
                    $deuda->update();
                }
                else
                {
                    $deuda = Deuda::findOrFail($dede->idDeuda);
                    $deuda->estado = 'deuda';
                    $deuda->update();
                }
                return redirect('ventas/deudas/pagar/'.$dede->idDeuda);
            }
            if ($variable[1]=='eliminarCompleto')
            {
                $deuda = Deuda::findOrFail($variable[0]);
                $deuda->delete();
                return redirect('ventas/deudas');
            }
    }
    public function imprimir ($id){
        $deudas = DB::table('deudas as d')
        ->join('clientes as c','c.idCliente','=','d.idCliente')
        ->join('servicios as s','s.idServicio','=','d.idServicio')
        ->select('d.idDeuda','c.dniRuc','c.nombre','c.apellido','s.nombre as nombreServicio','d.estado','d.fDeuda','d.observacion','d.numero')
        ->where('d.idDeuda','=',$id)
        ->first();
        $deudasDetalles = DB::table('deudas_detalles')
        ->where('idDeuda','=',$id)
        ->get();
        return view('ventas.deudas.imprimir',compact('deudas','deudasDetalles'));
		$pdf = PDF::loadview("ventas.deudas.imprimir",['deudas'=>$deudas,'deudasDetalles'=>$deudasDetalles]);
		$pdf->setPaper('a4','landscape');
		return $pdf->download('deuda-'.$deudas->numero.'-'.$deudas->dniRuc.'.pdf');
    }
    public function pagar($id)
    {
        //LISTA DETALLADA DE LAS CUOTAS
        $deudas = DB::table('deudas as d')
        ->join('clientes as c','c.idCliente','=','d.idCliente')
        ->join('servicios as s','s.idServicio','=','d.idServicio')
        ->select('d.idDeuda','c.dniRuc','c.nombre','c.apellido','s.nombre as nombreServicio','d.estado','d.fDeuda','d.observacion','d.numero')
        ->where('d.idDeuda','=',$id)
        ->first();
        $deudasDetalles = DB::table('deudas_detalles')
        ->where('idDeuda','=',$id)
        ->get();
        return view('ventas.deudas.pagar',['deudas'=>$deudas,'deudasDetalles'=>$deudasDetalles]);
    }
    public function impriAmortizar($id)
    {
        $dede = DeudaDetalle::findOrFail($id);
        $deudas = DB::table('deudas as d')
        ->join('clientes as c','c.idCliente','=','d.idCliente')
        ->join('servicios as s','s.idServicio','=','d.idServicio')
        ->select('d.idDeuda','c.dniRuc','c.nombre','c.apellido','s.nombre as nombreServicio','d.estado','d.fDeuda','d.observacion','d.numero')
        ->where('d.idDeuda','=',$dede->idDeuda)
        ->first();
        $deudasDetalles = DB::table('deudas_detalles')
        ->where('idDeuda','=',$dede->idDeuda)
        ->get();
		$pdf = PDF::loadview("ventas.deudas.imprimir",['deudas'=>$deudas,'deudasDetalles'=>$deudasDetalles]);
		$pdf->setPaper('a4','landscape');
		return $pdf->download('deuda-'.$deudas->numero.'-'.$deudas->dniRuc.'.pdf');
    }
}

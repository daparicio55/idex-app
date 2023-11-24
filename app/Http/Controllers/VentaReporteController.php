<?php

namespace App\Http\Controllers;

use App\Exports\VentaExport;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Serverless\V1\Service\FunctionContext;

class VentaReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $anios = [
            2023=>2023,
            2022=>2022,
            2021=>2021,
            2020=>2020
        ];
        $meses=[
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octube',
            'Noviembre',
            'Diciembre'
        ];
        if(isset($request->anio)){
            $startdate = Carbon::createFromDate($request->anio,1,1)->startofDay();
            $enddate = Carbon::createFromDate($request->anio,12,31)->endOfDay();
            $ventas = Venta::whereBetween('fecha',[$startdate,$enddate])
            ->where('estado','=','activo')
            ->get();
            $ventas_servicios = DB::table('ventasdetalles as vd')
            ->select(DB::raw('COUNT(*) as cantidad,s.nombre as nombre,MONTH(v.fecha) as mes,SUM(vd.cantidad * vd.precio) as total'))
            ->join('ventas as v','v.idVenta','=','vd.idVenta')
            ->join('servicios as s','s.idServicio','=','vd.idServicio')
            ->whereBetween('fecha',[$startdate,$enddate])
            ->where('v.estado','=','activo')
            ->groupByRaw('nombre,mes')
            ->orderBy('mes','asc')
            ->get();          
            return view('ventas.reportes.index',compact('anios','ventas','meses','ventas_servicios'));
        }
        return view('ventas.reportes.index',compact('anios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function excel(Request $request){
		return Excel::download(new VentaExport($request),'Reporte.xlsx');
    }
    public function create(Request $request)
    {
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
		return view('ventas.ventas.reportes.reporte',compact('ventas'));
    }

    
}

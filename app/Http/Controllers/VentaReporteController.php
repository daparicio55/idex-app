<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            //dd($ventas_servicios);
            

            return view('ventas.reportes.index',compact('anios','ventas','meses','ventas_servicios'));
        }
        return view('ventas.reportes.index',compact('anios'));
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
    }
}

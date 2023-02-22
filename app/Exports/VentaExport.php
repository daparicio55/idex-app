<?php

namespace App\Exports;

use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class VentaExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $datos;
    public function __construct($datos)
    {
        $this->datos = $datos;
    }
    public function styles(Worksheet $sheet){
        /* $sheet->getStyle('J8:S8')->getAlignment()->setTextRotation(90); */
        return [
            'A1'=>['font'=>[
                'bold'=>true,
                'size'=>20
            ]
            ]
        ];
    }
    public function view(): View{
        $servicio = 'todos';
        if ($this->datos[4]==0){
            $ventas = Venta::whereBetween('fecha',[$this->datos[2],$this->datos[3]])
            ->orderBy('idVenta','asc')
            ->get();
            $sumaTotal=DB::table('ventas as v')
            ->join('clientes as c','c.idCliente','=','v.idCliente')
            ->join('ventasdetalles as vd','v.idVenta','=','vd.idVenta')
            ->select(DB::raw('SUM(v.total) as sumaTotal'))
            ->where ('v.estado','=','activo')
            ->whereBetween('v.fecha',[$this->datos[2],$this->datos[3]])
            ->first();
        }else{
            $servicio_id = $this->datos[4];
            $ventas = Venta::whereBetween('fecha',[$this->datos[2],$this->datos[3]])
			->whereHas('detalles.servicio',function($query) use($servicio_id){
				$query->where('idServicio','=',$servicio_id);
			})->orderBy('idVenta','asc')
			->get();
            $sumaTotal=DB::table('ventas as v')
			->join('clientes as c','c.idCliente','=','v.idCliente')
			->join('ventasdetalles as vd','v.idVenta','=','vd.idVenta')
			->select(DB::raw('SUM(v.total) as sumaTotal'))
			->where('v.estado','=','activo')
			->where('vd.idServicio','=',$this->datos[4])
			->whereBetween('v.fecha',[$this->datos[2],$this->datos[3]])
			->first();
			$serv = DB::table('servicios')
			->where('idServicio','=',$this->datos[4])
			->first();
			$servicio = $serv->nombre;
        }
        $datos = $this->datos;
        return view('ventas.ventas.excel',compact('sumaTotal','servicio','ventas','datos'));
    }
}

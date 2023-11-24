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
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
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
        $request = $this->request;
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
        return view('ventas.ventas.excel',compact('ventas'));
    }
}

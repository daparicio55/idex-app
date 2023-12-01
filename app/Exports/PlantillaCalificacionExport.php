<?php

namespace App\Exports;

use App\Models\Ematricula;
use App\Models\Udidactica;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlantillaCalificacionExport implements FromView,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            'A1:D1'=>[
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => '54A0D4', // Color azul
                    ],
                ],
                'font' => [
                    'color' => [
                        'rgb' => 'FFFFFF', // Color blanco
                    ],
                    'size' => 12, // Tamaño de fuente 14
                ],
            ],
        ];
    }
    public function view(): View
    {
        $request = $this->request;
        $unidad = Udidactica::find($request->udidactica_id);
        $e = Ematricula::where('pmatricula_id','=',$request->periodo_id)
        ->where('licencia','=','NO')
        ->whereHas('detalles',function($q){
            $q->where('ematricula_detalles.tipo','=','Regular')
            ->orWhere('ematricula_detalles.tipo','=','Repitencia');
        })->whereHas('detalles',function($query) use($request){
            $query->where('udidactica_id','=',$request->udidactica_id)
            ->where('ematricula_detalles.tipo','!=','Convalidacion');
        })
        ->get();
        $estudiantes = $e->sortBy([
            'estudiante.postulante.cliente.apellido',
            'estudiante.postulante.cliente.nombre',
        ]);
        //dd($estudiantes->sortBy('estudiante.postulante.cliente.apellido'));

        $eestudiantes = [];
        if(isset($unidad->old->id)){
            $ee = Ematricula::where('pmatricula_id','=',$request->periodo_id)
        ->where('licencia','=','NO')
        ->whereHas('detalles',function($q){
            $q->where('ematricula_detalles.tipo','=','Regular')
            ->orWhere('ematricula_detalles.tipo','=','Repitencia');
        })->whereHas('detalles',function($query) use($unidad){
            $query->where('udidactica_id','=',$unidad->old->id)
            ->where('ematricula_detalles.tipo','!=','Convalidacion');
        })->get();
        $eestudiantes = $ee->sortBy([
            'estudiante.postulante.cliente.apellido',
            'estudiante.postulante.cliente.nombre',
        ]);
        }
        return view('exports.indicadores.plantilla',compact('eestudiantes','estudiantes'));
    }
}

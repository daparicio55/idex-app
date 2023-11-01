<?php

namespace App\Exports;

use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\Pmatricula;
use App\Models\Udidactica;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Nomina1Export implements FromView, WithStyles, ShouldAutoSize, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $carrera_id;        
    private $periodo_id;
    private $ciclo;
    
    public function __construct($carrera_id,$periodo_id,$ciclo)
    {
        $this->carrera_id = $carrera_id;
        $this->periodo_id = $periodo_id;
        $this->ciclo = $ciclo;
    }
    public function columnWidths(): array
    {
        return [
            'J' => 5,
            'K' => 5,            
            'L' => 5,
            'M' => 5,
            'N' => 5,
            'O' => 5,
            'P' => 5,
            'Q' => 5,
            'R' => 5,
            'S' => 5,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('J8:S8')->getAlignment()->setTextRotation(90);
        
    }
    public function view(): View
    {
        //la carrera
        $carr = Carrera::findOrFail($this->carrera_id);
        $periodo = Pmatricula::findOrfail($this->periodo_id);
        $modulos = Udidactica::where('ciclo','=',$this->ciclo)
        ->whereRelation('modulo','carrera_id','=',$carr->idCarrera)
        ->orderBy('nombre','asc')
        ->get();

        $estudiantes = DB::table('ematriculas as ema')
        ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
        ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
        ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
        ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
        ->join('estudiantes as es','es.id','=','ema.estudiante_id')
        ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
        ->join('admisiones as adm','adm.id','=','pos.admisione_id')
        ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
        ->where('ema.pmatricula_id','=',$periodo->id)
        ->where('ud.ciclo','=',$this->ciclo)
        ->where('mf.carrera_id','=',$carr->idCarrera)
        ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
        ->orderBy('cli.apellido','asc')
        ->orderBy('cli.nombre','asc')
        ->get();
        $eestudiantes = DB::table('ematriculas as ema')
        ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
        ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
        ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
        ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
        ->join('estudiantes as es','es.id','=','ema.estudiante_id')
        ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
        ->join('admisiones as adm','adm.id','=','pos.admisione_id')
        ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
        ->where('ema.pmatricula_id','=',$periodo->id)
        ->where('ud.ciclo','<>','V')
        /* ->where('ud.ciclo','<>','VI') */
        ->where('mf.carrera_id','=',$carr->ccarrera_id)
        ->where(function($query){
            $query->where('emad.tipo','Regular')->orWhere('emad.tipo','Repitencia');
        })
        ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad')
        ->orderBy('cli.apellido','asc')
        ->orderBy('cli.nombre','asc')
        ->get();
        return view('exports.nomina1',['carr'=>$carr,'eestudiantes'=>$eestudiantes,'periodo'=>$periodo,'modulos'=>$modulos,'ciclo'=>$this->ciclo,'estudiantes'=>$estudiantes]);
    }
}

<?php

namespace App\Exports;

use App\Models\Carrera;
use App\Models\Ematricula;
use App\Models\Udidactica;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Nomina2Export implements FromView, ShouldAutoSize, WithStyles
{
    /**
    * 
    */
    private $matricula_id;
    private $udidactica_id;
    private $carrera;
    private $ciclo;
    public function __construct($matricula_id,$udidactica_id,$carrera,$ciclo)
    {
        $this->matricula_id = $matricula_id;
        $this->udidactica_id = $udidactica_id;
        $this->carrera = $carrera;
        $this->ciclo = $ciclo;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => [
                'font'=>['size'=>13],
            ],
            'A3' => [
                'font'=>['size'=>13],
            ],
        ];
    }
    public function view(): View
    {
        $carrera = Carrera::findOrFail($this->carrera);
        $unidad = Udidactica::findOrFail($this->udidactica_id);
        $estudiantes = DB::table('ematriculas as ema')
        ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre as unidad')
        ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
        ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
        ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
        ->join('estudiantes as es','es.id','=','ema.estudiante_id')
        ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
        ->join('admisiones as adm','adm.id','=','pos.admisione_id')
        ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
        ->where('ema.pmatricula_id','=',$this->matricula_id)
        ->where('ud.id','=',$this->udidactica_id)
        ->where('emad.tipo','!=','Convalidacion')
        ->where(function($query){
            $query->where('emad.tipo','Regular')->orWhere('emad.tipo','Repitencia');
        })
        ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre')
        ->orderBy('unidad','asc')
        ->orderBy('cli.apellido','asc') 
        ->orderBy('cli.nombre','asc')
        ->get();

        $eestudiantes = DB::table('ematriculas as ema')
        ->select('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre as unidad')
        ->join('ematricula_detalles as emad','emad.ematricula_id','=','ema.id')
        ->join('udidacticas as ud','ud.id','=','emad.udidactica_id')
        ->join('mformativos as mf','mf.id','=','ud.mformativo_id')
        ->join('estudiantes as es','es.id','=','ema.estudiante_id')
        ->join('admisione_postulantes as pos','pos.id','=','es.admisione_postulante_id')
        ->join('admisiones as adm','adm.id','=','pos.admisione_id')
        ->join('clientes as cli','cli.idCliente','=','pos.idCliente')
        ->where('ema.pmatricula_id','=',$this->matricula_id)
        //->where('ud.ciclo','=',$ciclo)
        ->where(function($query){
            $query->where('emad.tipo','Regular')->orWhere('emad.tipo','Repitencia');
        })
        ->where('mf.carrera_id','=',$carrera->ccarrera_id)
        ->groupBy('ema.licencia','adm.periodo','cli.apellido','cli.nombre','cli.dniRuc','ema.id','cli.telefono','cli.telefono2','pos.fechaNacimiento','pos.sexo','pos.discapacidad','ud.nombre')
        ->orderBy('unidad','asc')
        ->orderBy('cli.apellido','asc') 
        ->orderBy('cli.nombre','asc')
        ->get();
        
        return view('exports.nomina2',['eestudiantes'=>$eestudiantes,'estudiantes'=>$estudiantes,'unidad'=>$unidad,'carrera'=>$carrera]);
    }
}

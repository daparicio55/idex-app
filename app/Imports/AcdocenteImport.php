<?php

namespace App\Imports;

use App\Models\Acdocente;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class AcdocenteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function newNumber(){
        $ultimo = Acdocente::orderBy('numero','desc')->first();
        if(isset($ultimo->numero)){
            return $ultimo->numero + 1;
        }else{
            return 1;
        }
    }
    public function model(array $row)
    {
        try {
            //code...
            $dni = $row[0];
            //buscamos el usuario con el DNI
            $docente = User::whereHas('personale',function($query) use($dni){
                $query->where('dni','=',$dni);
            })->first();
            if(isset($docente->id)){
                return new Acdocente([
                    'numero'=>$this->newNumber(),
                    'vitales_fc'=>$row[1],
                    'vitales_fr'=>$row[2],
                    'vitales_sys'=>$row[3],
                    'vitales_dia'=>$row[4],
                    'vitales_temperatura'=>$row[5],
                    'vitales_saturacion'=>$row[6],
                    'nutri_peso'=>$row[7],
                    'nutri_talla'=>$row[8],
                    'nutri_perimetro'=>$row[9],
                    'lab_glicemia'=>$row[10],
                    'lab_trigliceridos'=>$row[11],
                    'lab_colesterol'=>$row[12],
                    'lab_hto'=>$row[13],
                    'lab_hemoglobina'=>$row[14],
                    'lab_hdl'=>$row[15],
                    'lab_ldl'=>$row[16],
                    'lab_fs'=>$row[17],
                    'lab_gs'=>$row[18],
                    'psi_resultado'=>$row[19],
                    'campania_id'=>$this->id,
                    'user_id'=>auth()->id(),
                    'docente_id'=>$docente->id,
                    'fecha'=>Carbon::now(),
                ]); 
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }    
    }
}

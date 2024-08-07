<?php

namespace App\Models;

use App\Models\Docentes\Recuperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmatriculaDetalle extends Model
{
    use HasFactory;
    public function matricula(){
        return $this->belongsTo(Ematricula::class,'ematricula_id');
    }
    public function unidad(){
        return $this->belongsTo(Udidactica::class,'udidactica_id');
    }
    public function recuperacion(){
        return $this->hasOne(Recuperation::class,'emd_id','id');
    }
}

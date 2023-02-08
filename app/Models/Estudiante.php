<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public function postulante(){
        return $this->belongsTo(AdmisionePostulante::class,'admisione_postulante_id');
    }
    public function matriculas(){
        return $this->hasMany(Ematricula::class,'estudiante_id');
    }
    public function acampanias(){
        return $this->hasMany(Acampania::class);
    }
    public function pmedico(){
        return $this->hasOne(Pmedico::class);
    }
    public function surveys(){
        return $this->hasMany(Sdo::class);
    }
}
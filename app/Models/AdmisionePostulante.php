<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmisionePostulante extends Model
{
    use HasFactory;
    public function carrera(){
        return $this->belongsTo(Carrera::class,'idCarrera');
    }
    public function cliente(){ 
        return $this->belongsTo(Cliente::class,'idCliente');
    }
    public function colegio(){
        return $this->belongsTo(Colegio::class,'colegio_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function admisione(){
        return $this->belongsTo(Admisione::class);
    }
    public function estudiante(){
        return $this->hasOne(Estudiante::class,'admisione_postulante_id');
    }
}

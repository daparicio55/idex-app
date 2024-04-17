<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ematricula extends Model
{
    use HasFactory;
    public function estudiante(){
        return $this->belongsTo(Estudiante::class,'estudiante_id');
    }
    public function matricula(){ 
        return $this->belongsTo(Pmatricula::class,'pmatricula_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function detalles(){
        return $this->hasMany(EmatriculaDetalle::class);
    }
    public function li(){
        return $this->hasOne(Licencia::class,'ematricula_id','id');
    }
}

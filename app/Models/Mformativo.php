<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mformativo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'horas',
        'creditos',
        'iformativo_id',
        'carrera_id'
    ];
    public function carrera(){
        return $this->belongsTo(Carrera::class,'carrera_id');
    }
    public function itinerario(){
        return $this->belongsTo(Iformativo::class,'iformativo_id');
    }
    public function unidades(){
        return $this->hasMany(Udidactica::class,'mformativo_id');
    }
    public function practica(){
        return $this->hasOne(Practica::class);
    }
    public function abilitys(){
        return $this->hasMany(Ability::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admisione extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'periodo',
        'fecha',
        'hora',
        'efecha',
        'ehora',
        'puntos',
        'encontra',
        'preguntas'
    ];
    public function postulantes(){
        return $this->hasMany(AdmisionePostulante::class);
    }
    public function alternativas(){
        return $this->hasMany(AdmisioneAlternativa::class);
    }
}

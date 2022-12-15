<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'ccarreras';
    protected $primaryKey = 'idCarrera';
    public $timestamps = false;
    protected $filltable = [
        'nombreCarrera',
        'observacionCarrera',
        'iformativo_id'
    ];
    public function itinerarios(){
        return $this->hasMany('App\Models\Iformativo','id');
    }
    public function modulos(){
        return $this->hasMany(Mformativo::class,'carrera_id');
    }
    public function postulantes(){
        return $this->hasMany(AdmisionePostulante::class,'idCarrera');
    }
    
}

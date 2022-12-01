<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cepre extends Model
{
    use HasFactory;
    protected $table = 'cepres';
    protected $primaryKey = 'idCepre';
    public $timestamps = false;
    protected $filltable = [
        'periodoCepre',
        'costoTotal',
        'costoCuota',
        'fechaMitad'
    ];
    public function CepreEstudiantes(){
        return $this->hasMany(CepreEstudiante::class,'idCepre');
    }
    public function sumativos(){
        return $this->hasMany(CepreSumativo::class,'cepre_id');
    }
}

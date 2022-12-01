<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeprePago extends Model
{
    use HasFactory;
    protected $table = 'cepre_pagos';
    protected $primaryKey = 'idCeprePago';
    public $timestamps = false;
    protected $filltable = [
        'idCepreEstudiante',
        'montoPago',
        'fechaPago',
        'tipoComprobante',
        'numeroComprobante'
    ];
    protected $guarded = [

    ];
    public function cepreEstudiante(){
        return $this->belongsTo('App\Models\CepreEstudiante','idCepreEstudiante');
    }
}

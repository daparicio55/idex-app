<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CepreEstudiante extends Model
{
    use HasFactory;
    protected $table = 'cepre_estudiantes';
    protected $primaryKey = 'idCepreEstudiante';
    public $timestamps = false;
    protected $filltable = [
        'url',
        'fechaNacimiento',
        'ieProcedencia',
        'ieDistrito',
        'ieProvincia',
        'ieDepartamento',
        'ieDireccion',
        'ceEsDepartamento',
        'ceEsProvincia',
        'ceEsDistrito',
        'ceEsDiscapacidad',
        'ceEsObservacion',
        'ceEsDisCertificado',
        'ceEsDisCerObservacion',
        'ceEsFecha',
        'conNombre',
        'conApellido',
        'conTelefono',
        'conDireccion',
        'conParentesco',
        'idCepre',
        'idCliente',
        'idCarrera',
        'id'
    ];
    protected $guarded = [

    ]; 
    public function carrera(){
        return $this->belongsTo('App\Models\Carrera','idCarrera');
    }
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente','idCliente');
    }
    public function cepre(){
        return $this->belongsTo('App\Models\Cepre','idCepre');
    }
    public function ceprePagos(){
        return $this->hasMany('App\Models\CeprePago','idCepreEstudiante');
    }
}

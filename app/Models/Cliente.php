<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'idCliente';
    public $timestamps = false;
    
    protected $filltable = [
        'dniRuc',
        'nombre',
        'apellido',
        'direccion',
        'email',
        'telefono',
        'estudiante',
        'telefono2'
    ];
    protected $guarded = [

    ];

    public function CepreEstudiantes(){
        return $this->hasMany('App\Models\CepreEstudiante','idCepreEstudiante');
    }
    public function cestudiantes(){
        return $this->hasMany(CepreEstudiante::class,'idCliente','idCliente');
    }
    public function repositorios(){
        return $this->hasMany(Repositorio::class);
    }
    public function deudas(){
        return $this->hasMany(Deuda::class,'idCliente');
    }
    public function postulaciones(){
        return $this->hasMany(AdmisionePostulante::class,'idCliente')->orderBy('created_at','desc');
    }
    public function ventas(){
        return $this->hasMany(Venta::class,'idCliente');
    }
    public function mayusculas(){
        $this->apellido = Str::upper($this->apellido);
        $this->nombre = Str::upper($this->nombre);
        $this->save();
    }
}

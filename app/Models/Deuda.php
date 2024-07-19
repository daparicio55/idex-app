<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;
    protected $table = 'deudas';
    public $timestamps = false;
    protected $primaryKey = 'idDeuda';
    public function cliente(){
        return $this->belongsTo(Cliente::class,'idCliente');
    }
    public function deudadetalles(){
        return $this->hasMany(DeudaDetalle::class,'idDeuda');
    }
    public function detalles(){
        return $this->hasMany(DeudaDetalle::class,'idDeuda');
    }
    public function servicio(){
        return $this->belongsTo(Servicio::class,'idServicio');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $table = 'ventasdetalles';
    protected $primaryKey = 'idVentasDetalles';
    public $timestamps = false;
    public function venta(){
        return $this->belongsTo(Venta::class,'idVenta');
    }
    public function servicio(){
        return $this->belongsTo(Servicio::class,'idServicio');
    }
}

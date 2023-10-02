<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicadore extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'capacidade_id'
    ];
    public function capacidade(){
        return $this->belongsTo(Capacidade::class);
    }
    public function aperturas(){
        return $this->morphMany(Apertura::class,'aperturable');
    }
    public function detalles(){
        return $this->hasMany(IndicadoreDetalle::class);
    }
}

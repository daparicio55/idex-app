<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacidade extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'uasignada_id',
        'nombre',
        'descripcion',
        'fecha'
    ];
    public function uasignada(){
        return $this->belongsTo(Uasignada::class);
    }
    public function indicadores(){
        return $this->hasMany(Indicadore::class);
    }
}

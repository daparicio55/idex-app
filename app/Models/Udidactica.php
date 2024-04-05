<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Udidactica extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'creditos',
        'horas',
        'ciclo',
        'moodle',
        'mformativo_id',
        'tipo',
        'orden',
    ];
    public function modulo(){
        return $this->belongsTo(Mformativo::class,'mformativo_id');
    }
    public function equivalencia(){
        return $this->belongsTo(Udidactica::class,'udidactica_id');
    }
    public function old(){
        return $this->hasOne(Udidactica::class,'udidactica_id');
    }
    public function capabilities(){
        return $this->hasMany(Capabilitie::class);
    }
    public function uasignadas(){
        return $this->hasMany(Uasignada::class);
    }
    public function ematricula_detalles(){
        return $this->hasMany(EmatriculaDetalle::class,'udidactica_id','id');
    }
    public function ematricula_detalles_eq(){
        return $this->hasMany(EmatriculaDetalle::class,'udidactica_id','udidactica_id');
    }
}

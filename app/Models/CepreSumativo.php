<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CepreSumativo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'fecha',
        'preguntas',
        'puntos',
        'encontra',
        'cepre_id',
    ];
    public function cepre(){
        return $this->belongsTo(Cepre::class,'cepre_id');
    }
    public function alternativas(){
        return $this->hasMany(CepreSumativoAlternativa::class);
    }
    public function resultados(){
        return $this->hasMany(CepreSumativoResultado::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmisioneVacante extends Model
{
    use HasFactory;
    protected $fillable = [
        'admisione_id',
        'carrera_id',
        'cantidad'
    ];
    public function carrera(){
        return $this->belongsTo(Carrera::class,'carrera_id');
    }
}

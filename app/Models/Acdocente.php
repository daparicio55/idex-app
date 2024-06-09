<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acdocente extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'numero',
        'fecha',
        'vitales_fc',
        'vitales_fr',
        'vitales_sys',
        'vitales_dia',
        'vitales_temperatura',
        'vitales_saturacion',
        'nutri_peso',
        'nutri_talla',
        'nutri_perimetro',
        'lab_glicemia',
        'lab_trigliceridos',
        'lab_colesterol',
        'lab_hto',
        'lab_hemoglobina',
        'lab_hdl',
        'lab_ldl',
        'lab_fs',
        'lab_gs',
        'psi_resultado',
        'campania_id',
        'user_id',
        'docente_id',
    ];
}

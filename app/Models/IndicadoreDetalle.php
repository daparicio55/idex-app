<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadoreDetalle extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'nota',
        'fecha',
        'user_id',
        'ematricula_detalle_id',
        'indicadore_id'
    ];
}

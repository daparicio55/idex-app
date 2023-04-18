<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterioDetalle extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'ematricula_detalle_id',
        'nota',
        'fecha',
        'user_id',
        'criterio_id'
    ];
}

<?php

namespace App\Models\Docentes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    use HasFactory;
    public $table = "emd_asistencias";
    public $fillable = [
        'estado',
        'fecha',
        'user_id',
        'emdetalle_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CepreEstudianteAsistencia extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'fecha',
        'estado',
        'cestudiante_id',
        'user_id'
    ];
}

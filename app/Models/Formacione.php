<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacione extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'inicio',
        'fin',
        'pais',
        'departamento',
        'institucion',
        'personale_id'
    ];
}

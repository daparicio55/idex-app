<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'descripcion',
        'capabilitie_id'
    ];
}

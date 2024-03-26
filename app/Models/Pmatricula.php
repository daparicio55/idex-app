<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmatricula extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ffin',
        'finicio'
    ];
    public function iformativo(){
        return $this->belongsTo(Iformativo::class);
    }
    public function asignaciones(){
        return $this->belongsTo(Uasignada::class);
    }
    public function uasignadas(){
        return $this->hasMany(Uasignada::class);
    }
    public function matriculas(){
        return $this->hasMany(Ematricula::class);
    }
}

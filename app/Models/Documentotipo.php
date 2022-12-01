<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentotipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
    ];
    public function repositorios(){
        return $this->hasMany(Repositorio::class);
    }
}

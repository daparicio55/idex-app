<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iformativo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'creditos'
    ];
    public function modulos(){
        return $this->hasMany(Mformativo::class,'iformativo_id');
    }
}

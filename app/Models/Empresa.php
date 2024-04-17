<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table="empresas";
    protected $primaryKey="idEmpresa";
    public $timestamps = false;
    public function practicas(){
        return $this->hasMany(Practica::class,'empresa_id','idEmpresa');
    }
}

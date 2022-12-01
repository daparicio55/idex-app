<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $primaryKey = 'idServicio';
    public $timestamps = false;
    public function deudas(){
        return $this->hasMany(Deuda::class,'idServicio');
    }
}

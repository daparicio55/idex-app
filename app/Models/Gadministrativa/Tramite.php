<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    public function requerimiento(){
        return $this->belongsTo(Requerimiento::class);
    }
    public function tramiteDetalles(){
        return $this->hasMany(TramiteDetalle::class);
    }
}

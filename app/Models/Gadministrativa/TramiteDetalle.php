<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TramiteDetalle extends Model
{
    use HasFactory;
    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }
    public function catalogo(){
        return $this->belongsTo(Catalogo::class);
    }
    public function precio(){
        return $this->hasOne(OcPrecio::class,'tdetalle_id','id');
    }
    public function cambio(){
        return $this->hasOne(TdCambio::class,'tdetalle_id','id');
    }
}

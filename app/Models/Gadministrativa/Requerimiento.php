<?php

namespace App\Models\Gadministrativa;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    use HasFactory;
    public function re_detalles(){
        return $this->hasMany(ReDetalle::class,'requerimiento_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tramites(){
        return $this->hasMany(Tramite::class);
    }
}

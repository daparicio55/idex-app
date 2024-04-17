<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;
    public function matricula(){
        return $this->belongsTo(Ematricula::class,'ematricula_id','id');
    }
    public function reingreso(){
        return $this->hasOne(Reingreso::class,'licencia_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function asignacione(){
        return $this->belongsTo(Uasignada::class,'uasignada_id');
    }
}

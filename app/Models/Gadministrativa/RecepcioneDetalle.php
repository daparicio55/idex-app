<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecepcioneDetalle extends Model
{
    use HasFactory;
    public $table = "redetalle";
    public function tdetalle(){
        return $this->belongsTo(TramiteDetalle::class);
    }
}

<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdCambio extends Model
{
    use HasFactory;
    public function catalogo(){
        return $this->belongsTo(Catalogo::class);
    }
}

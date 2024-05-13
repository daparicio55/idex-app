<?php

namespace App\Models\Gadministrativa;

use App\Models\Marca;
use App\Models\Tipo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;
    public function marca(){
        return $this->belongsTo(Marca::class);
    }
    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }
    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }
}

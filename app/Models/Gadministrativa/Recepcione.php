<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcione extends Model
{
    use HasFactory;
    public function newNumber(){
        $ultimo = Recepcione::orderBy('numero','desc')->first();
        if(isset($ultimo->numero)){
            return $ultimo->numero + 1;
        }else{
            return 1;
        }
    }
    public function ocompra(){
        return $this->belongsTo(Ocompra::class);
    }
    public function redetalles(){
        return $this->hasMany(RecepcioneDetalle::class,'recepcione_id');
    }
}

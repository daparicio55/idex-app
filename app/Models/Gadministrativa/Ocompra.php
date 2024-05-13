<?php

namespace App\Models\Gadministrativa;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocompra extends Model
{
    use HasFactory;



    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }

    public function newNumber(){
        $ultimo = Ocompra::orderBy('numero','desc')->first();
        if(isset($ultimo->numero)){
            return $ultimo->numero + 1;
        }else{
            return 1;
        }
    }
    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresa_id','idEmpresa');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
} 

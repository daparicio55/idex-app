<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReDetalle extends Model
{
    use HasFactory;
    public function requerimiento(){
        return $this->belongsTo(Requerimiento::class);
    }
    public function ncatalogo(){
        return $this->belongsTo(NacionalCatalogo::class,'ncatalogo_id','id');
    }
}

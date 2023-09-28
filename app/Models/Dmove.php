<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dmove extends Model
{
    use HasFactory;
    public function documento(){
        return $this->belongsTo(Document::class,'document_id');
    }
    public function receptor(){
        return $this->belongsTo(User::class,'recive_id');
    }
    public function envia(){
        return $this->belongsTo(User::class,'envia_id');
    }
    public function enviaresponsable(){
        return $this->belongsTo(User::class,'enviaresponsable_id','id');
    }
    public function reciberesponsable(){
        return $this->belongsTo(User::class,'reciveresponsable_id','id');
    }
}

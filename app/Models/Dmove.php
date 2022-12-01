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
}

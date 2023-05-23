<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uasignada extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function periodo(){
        return $this->belongsTo(Pmatricula::class,'pmatricula_id');
    }
    public function unidad(){
        return $this->belongsTo(Udidactica::class,'udidactica_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function aperturas(){
        return $this->morphMany(Apertura::class,'aperturable');
    }
    public function capacidades(){
        return $this->hasMany(Capacidade::class);
    }
}

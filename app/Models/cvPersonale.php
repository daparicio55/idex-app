<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cvPersonale extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function estudios(){
        return $this->hasMany(cvEstudio::class);
    }
    public function experiencias(){
        return $this->hasMany(cvExperiencia::class);
    }
    public function conocimientos(){
        return $this->hasOne(cvConocimiento::class);
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}

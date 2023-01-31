<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdo extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
    public function survey(){
        return $this->belongsTo(Survey::class);
    }
    public function sddo(){
        return $this->hasMany(Sddo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campania extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function atenciones(){
        return $this->hasMany(Acampania::class);
    }
}

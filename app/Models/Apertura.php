<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apertura extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function aperturable(){
        return $this->morphTo();
    }

}

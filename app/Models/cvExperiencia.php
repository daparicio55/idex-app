<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cvExperiencia extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function personale(){
        return $this->belongsTo(cvPersonale::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personale extends Model
{
    use HasFactory;
    public function formaciones(){
        return $this->hasMany(Formacione::class);
    }
}

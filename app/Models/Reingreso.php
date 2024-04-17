<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reingreso extends Model
{
    use HasFactory;
    public function licencia(){
        return $this->belongsTo(Licencia::class);
    }
}

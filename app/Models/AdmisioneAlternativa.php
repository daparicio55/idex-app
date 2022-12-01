<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmisioneAlternativa extends Model
{
    use HasFactory;
    public function admisione(){
        return $this->belongsTo(Admisione::class);
    }
}

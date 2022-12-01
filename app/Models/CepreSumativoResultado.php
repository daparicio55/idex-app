<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CepreSumativoResultado extends Model
{
    use HasFactory;
    public function sumativo(){
        return $this->belongsTo(CepreSumativo::class);
    }
}

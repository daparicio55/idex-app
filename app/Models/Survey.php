<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function questions(){
        return $this->hasMany(Squestion::class);
    }

}

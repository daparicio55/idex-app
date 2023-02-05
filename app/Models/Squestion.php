<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squestion extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = ['id'];
    public function survey(){
        return $this->belongsTo(Survey::class);
    }
    public function alternatives(){
        return $this->hasMany(Sqalternative::class);
    }
}

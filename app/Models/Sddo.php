<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sddo extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function sdo(){
        return $this->belongsTo(Sdo::class);
    }
    public function alternative(){
        return $this->belongsTo(Sqalternative::class,'sqalternative_id');
    }
}

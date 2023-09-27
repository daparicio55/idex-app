<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;
    protected $table = 'oficinas';
    protected $primaryKey = 'idOficina';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'estado',
        'user_id'
    ];
    public function users(){
        return $this->hasMany('App\Models\User','id');
    }
    public function responsable(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

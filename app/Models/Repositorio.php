<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;

class Repositorio extends Model
{
    use HasFactory; 
    protected $fillable = [
        'fecha',
        'asunto',
        'numero',
        'url',
        'documentotipo_id',
        'user_id',
        'idCliente'
    ];
    public function documentotipo(){
        return $this->belongsTo(Documentotipo::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class,'idCliente');
    }
}

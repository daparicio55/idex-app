<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmedico extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'estudiante_id',
        'lab_gs',
        'lab_fs',
        'nutri_talla'
    ];
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}

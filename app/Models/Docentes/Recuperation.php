<?php

namespace App\Models\Docentes;

use App\Models\EmatriculaDetalle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'emd_id',
        'nota',
        'observacion'
    ];
    public function ematriculaDetalle(){
        return $this->belongsTo(EmatriculaDetalle::class,'emd_id','id');
    }
}

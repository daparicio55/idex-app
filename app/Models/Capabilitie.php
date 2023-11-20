<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capabilitie extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'descripcion',
        'udidactica_id',
    ];
    public function indicators(){
        return $this->hasMany(Indicator::class);
    }
}

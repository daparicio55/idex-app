<?php

namespace App\Models\Gadministrativa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcPrecio extends Model
{
    use HasFactory;
    public $fillable = [
        'valor',
        'tdetalle_id'
    ];
}

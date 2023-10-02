<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeudaDetalle extends Model
{
    use HasFactory;
    protected $table = 'deudas_detalles';
    public $timestamps = false;
    protected $primaryKey = 'idDeDe';
} 

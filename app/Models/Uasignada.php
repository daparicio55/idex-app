<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uasignada extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function periodo(){
        return $this->belongsTo(Pmatricula::class,'pmatricula_id');
    }
    public function unidad(){
        return $this->belongsTo(Udidactica::class,'udidactica_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function aperturas(){
        return $this->morphMany(Apertura::class,'aperturable');
    }
    public function capacidades(){
        return $this->hasMany(Capacidade::class);
    }
    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    public function snyc_horarios($dias,$inicio,$fin){
        //borramos los horarios anteriores
        Horario::where('uasignada_id','=',$this->id)->delete();
        //ingresamos los nuevos
        for ($i=0; $i < count($dias) ; $i++) { 
            # code...
            $horario = new Horario();
            $horario->day = $dias[$i];
            $horario->hinicio = $inicio[$i];
            $horario->hfin=$fin[$i];
            $horario->uasignada_id = $this->id;
            $horario->save();
        }
    }
}

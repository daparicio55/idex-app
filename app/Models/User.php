<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'email',
        'idOficina'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function adminlte_desc(){
        return oficinaNombre();
    }
    public function oficina(){
        return $this->belongsTo('App\Models\Oficina','idOficina');
    }
    public function repositorios(){
        return $this->hasMany(Repositorio::class);
    }
    public function unidades(){
        return $this->hasMany(Uasignada::class);
    }
    public function personale(){
        return $this->hasOne(cvPersonale::class,'user_id');
    }
    public function ucliente(){
        return $this->hasOne(Ucliente::class);
    }
    public function acampanias(){
        return $this->hasMany(Acdocente::class,'docente_id','id');
    }
    public function adminlte_image(){
        $user = User::findOrFail(auth()->id());
        if(isset($user->ucliente->cliente_id)){
            $estudiante = Estudiante::whereHas('postulante',function($query) use($user){
                $query->where('idCliente','=',$user->ucliente->cliente_id);
            })->get();
            return Storage::url($estudiante[0]->postulante->url);
        }else{
            //si es profesor
            $cv = cvPersonale::where('user_id','=',$user->id)->get();
            if(isset($cv[0]->perFoto)){
                return Storage::url($cv[0]->perFoto);
            }else{
                return Storage::url("blank-profile-picture-973460_640.png");
            }
        }
    }
}

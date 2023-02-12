<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
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
}

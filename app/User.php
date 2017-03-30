<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $fillable = [
        'nombre', 'username', 'email', 'password', 'perfil_id'
    ];

    protected $hidden = [
        'username', 'password', 'remember_token', 'created_at', 'updated_at', 'pivot'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }  
    public function perfil()
    {        
        return $this->hasOne('App\Perfil', 'id', 'perfil_id');
    }
    public function admin()
    {        
        return $this->hasOne('App\Admin');
    }
}
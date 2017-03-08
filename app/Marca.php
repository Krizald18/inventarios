<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
    	'id', 'marca'
    ]; 

    protected $hidden = [
        
    ];
    public function modelos()
    {        
        return $this->hasMany('App\Modelo');
    }
}
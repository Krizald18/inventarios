<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = [
    	'id', 'municipio'
    ]; 

    protected $hidden = [
        
    ];

   	public function localidades()
    {        
        return $this->hasMany('App\Localidad', 'municipio_id');
    }
}
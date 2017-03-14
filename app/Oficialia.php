<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Oficialia extends Model
{
    protected $fillable = [
    	'id', 'oficialia', 'municipio_id'
    ]; 

    protected $hidden = [
        
    ];
    public function getIdAttribute($value)
    {
        return (string) $value;
    }
    public function municipio()
    {        
        return $this->hasOne('App\Municipio', 'id', 'municipio_id');
    }
    public function responsable()
    {        
        return $this->hasOne('App\Responsable');
    }
}
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Oficialia extends Model
{
    protected $fillable = [
    	'id', 'oficialia', 'municipio_id'
    ]; 

    protected $hidden = [
        'municipio_id'
    ];
    public function getIdAttribute($value)
    {
        return (string) $value;
    }
    public function municipio()
    {        
        return $this->hasOne('App\Municipio', 'id', 'municipio_id');
    }
}
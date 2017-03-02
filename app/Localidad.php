<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
    	'id', 'localidad', 'municipio_id'
    ]; 

    protected $hidden = [
		'municipio_id' 
    ];

    public function municipio()
    {        
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
}
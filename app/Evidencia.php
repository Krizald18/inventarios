<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $fillable = [
    	'id', 'uri', 'file', 'resguardo_id'
    ]; 

    protected $hidden = [
        'resguardo_id'
    ];

    public function resguardo()
    {        
        return $this->belongsTo('App\Resguardo');
    }
}
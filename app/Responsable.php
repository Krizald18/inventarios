<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $casts = [
        
    ];

    protected $fillable = [
    	'id', 'responsable', 'usuario_id'
    ]; 

    protected $hidden = [
    	'usuario_id'
    ];
    public function usuario()
    {        
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }
}
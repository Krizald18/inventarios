<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Oficialia extends Model
{
    protected $fillable = [
    	'id', 'oficialia'
    ]; 

    protected $hidden = [
        
    ];
    public function getIdAttribute($value)
    {
        return (string) $value;
    }
}
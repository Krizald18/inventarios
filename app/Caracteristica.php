<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = [
    	'id', 'caracteristica'
    ]; 

    protected $hidden = [

    ];
}
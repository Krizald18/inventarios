<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Descripcion extends Model
{
    protected $table = 'descripciones';

    protected $fillable = [
    	'id', 'descripcion'
    ]; 

    protected $hidden = [
        
    ];

}
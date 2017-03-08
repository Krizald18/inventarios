<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = [
    	'id', 'caracteristica', 'subgrupo_id'
    ]; 

    protected $hidden = [
		'subgrupo_id'
    ];
    public function subgrupo()
    {   
        return $this->hasOne('App\Subgrupo', 'id', 'subgrupo_id');
    }
}
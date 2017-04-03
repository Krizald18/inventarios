<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $casts = [
        
    ];

    protected $fillable = [
    	'id', 'area'
    ]; 

    protected $hidden = [

    ];
    public function articulos()
    {
        return $this->hasMany('App\Inventario', 'area_id');
    }
}
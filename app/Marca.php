<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
  protected $fillable = [
    'id', 'marca', 'subgrupo_id'
  ]; 

  protected $hidden = [
    'subgrupo_id', 'pivot'
  ];

  public function modelos() {        
    return $this->hasMany('App\Modelo');
  }

  public function subgrupos() {
    return $this->belongsToMany('App\Subgrupo');
    // return $this->belongsToMany('App\Subgrupo', 'marca_subgrupo');
  }
}

<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {
  protected $casts = [
    
  ];

  protected $fillable = [
    'id', 'grupo'
  ];

  protected $hidden = [

  ];
  
  public function subgrupos() {
    return $this->hasMany('App\Subgrupo');
  }
}

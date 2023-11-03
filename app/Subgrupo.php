<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model {
  protected $fillable = [
    'id', 'subgrupo', 'grupo_id'
  ]; 

  protected $hidden = [
    'grupo_id'
  ];

  public function grupo() {
    return $this->belongsTo('App\Grupo', 'grupo_id', 'id');
  }

  public function marcas() {
    return $this->belongsToMany('App\Marca');
  }
}
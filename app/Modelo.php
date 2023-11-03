<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model {
  protected $fillable = [
    'id', 'modelo', 'marca_id', 'caracteristica_id'
  ]; 

  protected $hidden = [
    
  ];

  public function marca() {
    return $this->belongsTo('App\Marca');
  }

  public function caracteristica() {
    return $this->hasOne('App\Caracteristica', 'id', 'caracteristica_id');
  }

  public function subgrupo() {
    return $this->hasOne('App\Subgrupo', 'id', 'subgrupo_id');
  }

  public function articulos() {
    return $this->hasMany('App\Inventario', 'modelo_id');
  }
}
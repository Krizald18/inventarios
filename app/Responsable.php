<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model {
  protected $casts = [
    
  ];

  protected $fillable = [
    'id', 'responsable', 'usuario_id'
  ]; 

  protected $hidden = [
    'usuario_id'
  ];

  public function usuario() {
    return $this->belongsTo('App\User', 'usuario_id', 'id');
  }

  public function oficialia() {
    return $this->belongsTo('App\Oficialia');
  }

  public function articulos_asignados() {
    return $this->hasMany('App\Inventario', 'responsable_id');
  }

  public function resguardos() {
    return $this->hasMany('App\Resguardo', 'responsable_id');
  }
}

<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Resguardo extends Model {
  protected $casts = [
    'status' => 'boolean',
    'pdf_generado' => 'boolean',
    'pdf_firmado' => 'boolean'
  ];

  protected $fillable = [
    'id', 'comentarios', 'responsable_id', 'status', 'folio'
  ]; 

  protected $hidden = [

  ];

  public function articulos() {
    return $this->hasMany('App\Inventario', 'resguardo_id');
  }

  public function responsable() {
    return $this->belongsTo('App\Responsable', 'responsable_id', 'id');
  }

  public function evidencias() {
    return $this->hasMany('App\Evidencia', 'resguardo_id');
  }
}
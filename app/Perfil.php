<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {
  protected $table = 'perfiles';

  protected $fillable = [
    'id', 'perfil'
  ]; 

  protected $hidden = [
    
  ];
}

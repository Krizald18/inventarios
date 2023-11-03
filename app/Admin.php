<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
  protected $casts = [
    
  ];

  protected $fillable = [
    'id', 'token', 'user_id'
  ]; 

  protected $hidden = [
    
  ];
}

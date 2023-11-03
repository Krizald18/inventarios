<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PantallaController extends Controller {
  public function nacimientos() {
    return 'nacimientos';
  }
  
  public function matrimonios() {
    return 'matrimonios';
  }
}

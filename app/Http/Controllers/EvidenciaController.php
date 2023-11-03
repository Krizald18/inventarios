<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Evidencia;

class EvidenciaController extends Controller {
  public function __construct() {
    $this->middleware(['cors', 'auth:api']);
  }

  public function index() {
    return Evidencia::all();
  }

  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show($id) {
    //
  }

  public function edit($id) {
    //
  }

  public function update(Request $request, $id) {
    //
  }

  public function destroy($id) {
    $obj = Evidencia::findOrFail($id);
    $obj->delete();
  }
}

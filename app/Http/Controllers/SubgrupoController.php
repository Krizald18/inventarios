<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subgrupo;
use App\User;
use Response;

class SubgrupoController extends Controller {
  public function __construct() {
    $this->middleware(['cors', 'auth:api']);
  }

  public function index(Request $request) {
    if ($request->has('grupo')) {
      return Subgrupo::with('grupo')
        ->where('grupo_id', '=', $request->input('grupo'))
        ->orderBy('subgrupo', 'asc')
        ->get();
    } else {
      return Subgrupo::with('grupo', 'marcas')
        ->orderBy('subgrupo', 'asc')
        ->get();
    }
  }

  public function create() {
    //
  }

  public function store(Request $request) {
    // validar admin_token y user
    // recive un id de un subgrupo, user (id) y  admin_token
    $this->validate($request, [
      'user' => 'required',
      'admin_token' => 'required',
      'subgrupo' => 'required|unique:subgrupos',
      'grupo_id' => 'required',
    ]);
    $u = User::with('admin')->find($request->user);
    if (!isset($u->admin) || isset($u->admin) &&
        $u->admin->token <> $request->admin_token)
      return Response::json('Error al validar token', 401);
    $nextid = \DB::table('subgrupos')->max('id');
    if (isset($nextid))
      $nextid = $nextid + 1;
    else
      $nextid = 1;
    $g = new Subgrupo;
    $g->id = $nextid;
    $g->subgrupo = $request->subgrupo;
    $g->grupo_id = $request->grupo_id;
    $g->save();
    return self::index($request);
    /*
    if ($request->has('data')) {
      $o = (object) $request->input('data');
      $nextid = \DB::table('subgrupos')->max('id');
      if (isset($nextid))
        $nextid = $nextid + 1;
      else
        $nextid = 1;
      $j = new Subgrupo;
      $j->id = $nextid;
      $j->Subgrupo = $o->Subgrupo;
      $j->save();
      return Subgrupo::with('grupo')->orderBy('subgrupo', 'asc')->get();
    } else {
      return $request;
    }
    */
  }

  public function show($id) {
    return Subgrupo::find($id);
  }

  public function edit($id) {
    //
  }

  public function update(Request $request, $id) {
    //
  }

  public function destroy(Request $request, $id) {
    // validar admin_token y user
    // recive un id de un subgrupo, user (id) y  admin_token
    $this->validate($request, [
      'user' => 'required',
      'admin_token' => 'required',
    ]);
    $u = User::with('admin')->find($request->user);
    if (!isset($u->admin) || isset($u->admin) &&
        $u->admin->token <> $request->admin_token)
      return Response::json('Error al validar token', 401);
    $g = Subgrupo::findOrFail($id);
    $g->delete();
    return self::index($request);
  }
}

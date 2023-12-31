<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Grupo;
use App\User;
use Response;

class GrupoController extends Controller {
  public function __construct() {
    $this->middleware(['cors', 'auth:api']);
  }

  public function index(Request $request) {
    if ($request->has('full')) {
      $x = Grupo::with(array('subgrupos' => function($q) {
          $q->with('marcas');
        }))->orderBy('grupo', 'asc')->get();
      foreach ($x as $grupo)
        foreach ($grupo->subgrupos as $subgrupo)
          foreach ($subgrupo->marcas as $marca)
            $marca->load(array('modelos' => function($q) use ($subgrupo) {
              $q->with('caracteristica');
              $q->where('subgrupo_id', intval($subgrupo->id));
            }));
      return $x;
    }
    return Grupo::with('subgrupos')->orderBy('grupo', 'asc')->get();
  }

  public function create() {
    //
  }

  public function store(Request $request) {
    // validar admin_token y user
    // recibe un id de un grupo, user (id) y admin_token
    $this->validate($request, [
      'user' => 'required',
      'admin_token' => 'required',
      'grupo' => 'required|unique:grupos',
    ]);
    $u = User::with('admin')->find($request->user);
    if (!isset($u->admin) || isset($u->admin) &&
        $u->admin->token <> $request->admin_token)
      return Response::json('Error al validar token', 401);
    $nextid = \DB::table('grupos')->max('id');
    if (isset($nextid))
      $nextid = $nextid + 1;
    else
      $nextid = 1;
    $g = new Grupo;
    $g->id = $nextid;
    $g->grupo = $request->grupo;
    $g->save();
    return self::index($request);
  }

  public function show($id) {
    return Grupo::find($id);
  }

  public function edit($id) {
    //
  }

  public function update(Request $request, $id) {
    //
  }

  public function destroy(Request $request, $id) {
    // validar admin_token y user
    // recibe un id de un grupo, user (id) y admin_token
    $this->validate($request, [
      'user' => 'required',
      'admin_token' => 'required',
    ]);
    $u = User::with('admin')->find($request->user);
    if (!isset($u->admin) || isset($u->admin) &&
        $u->admin->token <> $request->admin_token)
      return Response::json('Error al validar token', 401);
    $g = Grupo::findOrFail($id);
    $g->delete();
    return self::index($request);
  }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Modelo;
use App\Marca;
use App\User;
use Response;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index(Request $request)
    {
        if($request->has('articulos'))
        return Modelo::with('marca', 'caracteristica', 'articulos', 'subgrupo')->orderBy('modelo', 'asc')->orderBy('marca_id', 'asc')->orderBy('subgrupo_id', 'asc')->get();
        else
            return Modelo::with('marca', 'caracteristica','subgrupo')->orderBy('modelo', 'asc')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // validar admin_token y user
        // recive un id de un modelo, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
            'subgrupo_id' => 'required',
            'marca_id' => 'required',
            'caracteristica_id' => 'required',
            'modelo' => 'required|unique_with:modelos,caracteristica_id,'.$request->caracteristica_id,
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);

        // ----------------checar si la marca esta asociada a ese subgrupo ---------------------
        $m = Marca::with('subgrupos')->whereHas('subgrupos', function($q) use ($request) {
                                            $q->where('subgrupo_id', '=', $request->subgrupo_id);
                                        })->where('id', $request->marca_id)->get();
        // marcas con ese id y que tengan ese subgrupo entre sus subgrupos. 0 no existe 1 si existe
        if(count($m) == 0) {
            // asociar marca con ese subgrupo
            $marca = Marca::find($request->marca_id);
            $marca->subgrupos()->attach($request->subgrupo_id);
        }
        // -------------------------------------------------------------------------------------

        $nextid = \DB::table('modelos')->max('id');
        if(isset($nextid))
            $nextid = $nextid + 1;
        else
            $nextid = 1;

        $g = new Modelo;
        $g->id = $nextid;
        $g->modelo = $request->modelo;
        $g->caracteristica_id = $request->caracteristica_id;
        $g->subgrupo_id = $request->subgrupo_id;
        $g->marca_id = $request->marca_id;
        $g->save();

        return Modelo::with('marca', 'caracteristica', 'articulos', 'subgrupo')->orderBy('modelo', 'asc')->orderBy('marca_id', 'asc')->orderBy('subgrupo_id', 'asc')->get();
        /*
        if($request->has('data'))
        {
            $o = (object) $request->input('data');

            $nextid = \DB::table('modelos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Modelo;

            $j->id = $nextid;
            $j->modelo = $o->modelo;

            $j->save();

            return Modelo::with('marca', 'caracteristica','subgrupo')->orderBy('modelo', 'asc')->get();
        }
        else
            return $request;
        */
    }

    public function show($id)
    {
        return Modelo::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        // validar admin_token y user
        // recive un id de un modelo, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);

        $g = Modelo::with('marca')->findOrFail($id);
        $subgrupo_id = $g->subgrupo_id;
        $g->delete();
        
        // si la marca se queda sin modelos en ese subgrupo, detach de ese subgrupo
        $marca = Marca::with(array('modelos' => function($q) use ($subgrupo_id){
                                $q->where('subgrupo_id', '=', $subgrupo_id);
                            }))->find($g->marca->id);
        if(count($marca->modelos) == 0)
            $marca->subgrupos()->detach($subgrupo_id);
        // -----
        return Modelo::with('marca', 'caracteristica', 'articulos', 'subgrupo')->orderBy('modelo', 'asc')->orderBy('marca_id', 'asc')->orderBy('subgrupo_id', 'asc')->get();
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Caracteristica;
use App\User;
use Response;

class CaracteristicaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function index()
    {
        return Caracteristica::with('subgrupo', 'modelos')->orderBy('caracteristica', 'asc')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // validar admin_token y user
        // recive un id de un grupo, user (id) y  admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $this->validate($request, [
            'caracteristica' => 'required|unique:caracteristicas',
        ]);

        $nextid = \DB::table('caracteristicas')->max('id');
        if(isset($nextid))
            $nextid = $nextid + 1;
        else
            $nextid = 1;

        $g = new Caracteristica;
        $g->id = $nextid;
        $g->caracteristica = $request->caracteristica;
        $g->save();

        return self::index();
        /*
        if($request->has('data'))
        {
            $o = (object) $request->input('data');

            $nextid = \DB::table('caracteristicas')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Caracteristica;

            $j->id = $nextid;
            $j->caracteristica = $o->caracteristica;

            $j->save();

            return Caracteristica::with('subgrupo')->orderBy('caracteristica', 'asc')->get();
        }
        else
            return $request;
            */
    }

    public function show($id)
    {
        return Caracteristica::find($id);
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
        // recive un id de un grupo, user (id) y  admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $g = Caracteristica::findOrFail($id);
        $g->delete();

        return self::index();
    }
}
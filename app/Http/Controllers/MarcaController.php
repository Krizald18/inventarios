<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Marca;
use App\User;
use Response;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Marca::with(
                    array('modelos' => function($q) {
                            $q->with(
                                array('subgrupo' => function($s){
                                    $s->with('grupo');
                                }));
                        })
                    )->orderBy('marca', 'asc')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // validar admin_token y user
        // recive un id de un marca, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
            'marca' => 'required|unique:marcas',
        ]);

        $u = User::with('admin')->find($request->user);
        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $nextid = \DB::table('marcas')->max('id');
        if(isset($nextid))
            $nextid = $nextid + 1;
        else
            $nextid = 1;

        $g = new Marca;
        $g->id = $nextid;
        $g->marca = $request->marca;
        $g->save();

        return self::index();
        /*
        if($request->has('data'))
        {
            $o = (object) $request->input('data');

            $nextid = \DB::table('marcas')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Marca;

            $j->id = $nextid;
            $j->marca = $o->marca;

            $j->save();

            return Marca::orderBy('marca', 'asc')->get();
        }
        else
            return $request;
            */
    }

    public function show($id)
    {
        return Marca::with(
                    array('modelos' => function($q) {
                            $q->with(
                                array('subgrupo' => function($s){
                                    $s->with('grupo');
                                }));
                        })
                    )->find($id);
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
        // recive un id de un marca, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $g = Marca::findOrFail($id);
        $g->delete();

        return self::index();
    }
}
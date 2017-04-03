<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Area;
use Response;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        // return getHostByName(getHostName());
        return Area::with('articulos')->orderBy('area', 'asc')->get();
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
            'area' => 'required|unique:areas',
        ]);

        $nextid = \DB::table('areas')->max('id');
        if(isset($nextid))
            $nextid = $nextid + 1;
        else
            $nextid = 1;

        $g = new Area;
        $g->id = $nextid;
        $g->area = $request->area;
        $g->save();

        return self::index();
        /*
        if($request->has('data'))
        {
            $o = (object) $request->input('data');

            $nextid = \DB::table('areas')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Area;

            $j->id = $nextid;
            $j->area = $o->area;

            $j->save();

            return Area::orderBy('area', 'asc')->get();
        }
        else
            return $request;
            */
    }

    public function show($id)
    {
        return Area::find($id);
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

        $g = Area::findOrFail($id);
        $g->delete();

        return self::index($request);
    }
}
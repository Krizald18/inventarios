<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function allUsers(Request $request)
    {
        // validar admin_token y user
        // recive user (id) y admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);
        return User::with('responsable')
                   ->with(array('responsable' => function($q){
                        $q->with('articulos_asignados');
                    }))
                   ->orderBy('nombre', 'asc')->get();
    }
    public function getUser(Request $request, $id)
    {
        // validar admin_token y user
        // recive un id de un id, user (id) y admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);
        return User::with(array('responsable' => function($q){
                                $q->with('articulos_asignados');
                            }))->find($id);
    }
    public function index(Request $request)
    {
        // validar admin_token y user
        // recive user (id) y admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);
        return User::with(array('responsable' => function($q){
                                $q->with('articulos_asignados');
                            }))->get();
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Responsable;
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
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);
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
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);
        return User::with('admin')->with(array('responsable' => function($q){
                                $q->with('articulos_asignados');
                            }))->find($id);
    }
    public function index(Request $request)
    {
        // validar admin_token y user
        // recive user (id) y admin_token        
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);

        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);
        return User::with(array('responsable' => function($q){
                                $q->with('articulos_asignados');
                            }))->get();
    }
    public function updateUser(Request $request, $id)
    {
        // validar admin_token y user
        // recive user (id) y admin_token        
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
            'usuario_id' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);

        if($request->has('command') && $request->command == 'toggle_admin')
        {
            $u = User::findOrFail($request->usuario_id);
            if(isset($u->perfil_id))
            {
                // si es el ultimo admin no puede dejar de serlo
                $admin = \DB::table('admins')->distinct('user_id')->count('user_id');
                if($admin == 1)
                    return Response::json('No se puede remover al ultimo admin existente', 300);
                $u->perfil_id = null;
                $u->admin()->delete();
            }
            else
            {
                $u->perfil_id = 1;
                $a = new Admin;
                $a->token = bcrypt($request->usuario_id.'|'.round(microtime(true) * 1000));
                $u->admin()->save($a);
            }
            $u->save();
            return self::getUser($request, $u->id);
        }
    }
    public function destroyUser(Request $request, $id)
    {
        // validar admin_token y user
        // recive un id de un marca, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if(!isset($u->admin) || isset($u->admin) && $u->admin->token <> $request->admin_token)
            return Response::json('Error al validar token', 401);

        $g = User::with('responsable')->findOrFail($id);
        if(isset($g->responsable))
        {
            $r = Responsable::find($g->responsable->id);
            $r->usuario_id = null;
            $r->save();
        }
        if(isset($g->admin))
            $g->admin()->delete();
        $g->delete();
        return self::index($request);
    }
}
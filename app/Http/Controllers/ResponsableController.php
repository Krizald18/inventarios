<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Responsable;
use App\Inventario;
use App\Resguardo;
use App\Evidencia;
use App\User;
use Response;
// use App\Oficialia;

class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Responsable::with('usuario')
                            ->with(array('resguardos' => function($q){
                                    $q->with(array('articulos' => function($a){
                                        $a->with(array('modelo' => function($q){
                                            $q->with('marca');
                                            $q->with('caracteristica');
                                            $q->with('subgrupo');
                                        }));
                                    }));
                                }))
                            ->with(array('articulos_asignados' => function($a){
                                $a->with(array('modelo' => function($q){
                                    $q->with('marca');
                                    $q->with('caracteristica');
                                    $q->with('subgrupo');
                                }));
                            }))
                            ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                            ->orderBy('responsable', 'asc')
                            ->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->has('data'))
        {
            $o = (object) $request->input('data');

            $nextid = \DB::table('responsables')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Responsable;

            $j->id = $nextid;
            $j->responsable = $o->responsable;

            $j->save();

            return self::index();
        }
        else
        {
            if($request->has('command'))
            {
                if($request->input('command') == 'transfer')
                {
                    $area = $request->has('area_id')? $request->input('area_id') : null;
                    foreach ($request->input('articulos') as $articulo) {
                        $i = Inventario::find($articulo);
                        $i->responsable_id = $request->input('nuevo_responsable');
                        $i->area_id = $area;
                        $i->status = true; // activo

                        $re = Responsable::find($i->responsable_id);
                        if(isset($re->oficialia_id))
                        {
                            //$o = Oficialia::find($re->oficialia_id);
                            $i->oficialia_id = $re->oficialia_id;
                            //$i->municipio_id = $o->municipio_id;
                        }
                        else
                            $i->oficialia_id = null;

                        if(isset($i->resguardo_id) && !is_null($i->resguardo_id))
                        {
                            $rid = $i->resguardo_id;
                            $i->resguardo_id = null;
                            $i->save();
                            if(isset($rid))
                            {
                                $r = Resguardo::with('articulos')->find($rid);
                                if(count($r->articulos) == 0)
                                {
                                    $e = Evidencia::where('resguardo_id', $r->id)->get();
                                    foreach ($e as $evidencia) {
                                        $evidencia->delete(); // borrar el registro de evidencias (no se borrarán los archivos)
                                    }
                                    $r->delete();
                                }
                                $r = Resguardo::with('articulos')->find($rid);
                            }
                        }
                        else
                            $i->save();
                    }
                    return 'done!';
                }

            }
            else{
                // validar admin_token y user
                // recive un id de un responsable, user (id) y  admin_token
                if(!$request->has('user') || !$request->has('admin_token'))
                    return Response::json($request, 500);
                $u = User::with('admin')->find($request->user);

                if($u->admin->token <> $request->admin_token)
                    return Response::json($request, 500);

                $this->validate($request, [
                    'responsable' => 'required|unique:responsables',
                ]);

                $nextid = \DB::table('responsables')->max('id');
                if(isset($nextid))
                    $nextid = $nextid + 1;
                else
                    $nextid = 1;

                $g = new Responsable;
                $g->id = $nextid;
                $g->responsable = $request->responsable;
                if($request->has('oficialia_id'))
                    $g->oficialia_id = $request->oficialia_id;
                $g->save();

                return self::index($request);
            }
        }
    }

    public function show($id)
    {
        return Responsable::with('usuario', 'articulos_asignados')
                          ->with(array('resguardos' => function($q){
                                    $q->with('articulos');
                                }))
                          ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                          ->orderBy('responsable', 'asc')
                          ->find($id);
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
        // recive un id de un responsable, user (id) y  admin_token
        $this->validate($request, [
            'user' => 'required',
            'admin_token' => 'required',
        ]);

        $u = User::with('admin')->find($request->user);
        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $g = Responsable::findOrFail($id);
        $g->delete();

        return self::index();
    }
}
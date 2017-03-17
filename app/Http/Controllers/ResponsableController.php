<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Responsable;

class ResponsableController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Responsable::with('usuario', 'articulos_asignados')
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

            return Responsable::with('usuario', 'articulos_asignados')
                            ->with(array('resguardos' => function($q){
                                    $q->with(array('articulos' => function($a){
                                        $a->with(array('modelo' => function($q){
                                            $q->with('marca');
                                            $q->with('caracteristica');
                                            $q->with('subgrupo');
                                        }));
                                    }));
                                }))
                            ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                            ->orderBy('responsable', 'asc')
                            ->get();
        }
        else
            return $request;
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

    public function destroy($id)
    {
        $obj = Responsable::find($id);
        $obj->delete();

        return Responsable::with('usuario', 'articulos_asignados', 'resguardos')
                          ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                          ->orderBy('responsable', 'asc')
                          ->get();
    }
}
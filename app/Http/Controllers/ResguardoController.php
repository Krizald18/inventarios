<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Resguardo;
use App\Inventario;
use App\Responsable;

class ResguardoController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Resguardo::with('articulos')->get();
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
            $nextid = \DB::table('resguardos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Resguardo;
            $j->id = $nextid;
            $j->responsable_id = $o->responsable_id;
            $j->push();

            if(isset($o->articulos))
            {
                foreach ($o->articulos as $articulo) {
                    $i = Inventario::find($articulo);
                    $i->resguardo_id = $nextid;
                    $i->save();
                }
            }

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
                            ->find($j->responsable_id);
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Resguardo::find($id);
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
        $obj = Resguardo::find($id);
        $obj->delete();

        return Resguardo::all();
    }
}
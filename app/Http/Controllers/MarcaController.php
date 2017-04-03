<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Marca;

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

    public function destroy($id)
    {
        return 'coming soon...';
        /*
        $obj = Marca::find($id);
        $obj->delete();

        return Marca::orderBy('marca', 'asc')->get();
        */
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Grupo;

class GrupoController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }

    public function index(Request $request)
    {
        if($request->has('full'))
        {
            $x = Grupo::with(
                    array('subgrupos' => function($q) {
                            $q->with('marcas');
                        })
                    )->orderBy('grupo', 'asc')->get();

            foreach ($x as $grupo)
                foreach ($grupo->subgrupos as $subgrupo)
                    foreach ($subgrupo->marcas as $marca)
                        $marca->load( array('modelos' => function($q) use ($subgrupo){
                                $q->with('caracteristica');
                                $q->where('subgrupo_id', intval($subgrupo->id));
                            }));

            return $x;
        }
        return Grupo::with('subgrupos')->orderBy('grupo', 'asc')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return Grupo::find($id);
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
        //
    }
}
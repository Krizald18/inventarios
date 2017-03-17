<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Modelo;

class ModeloController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Modelo::with('marca', 'caracteristica','subgrupo')->orderBy('modelo', 'asc')->get();
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

            $nextid = \DB::table('modelos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Modelo;

            $j->id = $nextid;
            $j->modelo = $o->modelo;

            $j->save();

            return Modelo::with('marca', 'caracteristica','subgrupo')->orderBy('modelo', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Modelo::find($id);
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
        $obj = Modelo::find($id);
        $obj->delete();

        return Modelo::with('marca', 'caracteristica','subgrupo')->orderBy('modelo', 'asc')->get();
    }
}
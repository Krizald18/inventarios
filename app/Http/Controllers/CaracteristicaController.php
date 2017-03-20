<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Caracteristica;
use Response;

class CaracteristicaController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }
    public function index()
    {
        return Caracteristica::with('subgrupo')->orderBy('caracteristica', 'asc')->get();
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

            $nextid = \DB::table('caracteristicas')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Caracteristica;

            $j->id = $nextid;
            $j->caracteristica = $o->caracteristica;

            $j->save();

            return Caracteristica::with('subgrupo')->orderBy('caracteristica', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Caracteristica::find($id);
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
        $obj = Caracteristica::find($id);
        $obj->delete();

        return Caracteristica::with('subgrupo')->orderBy('descripcion', 'asc')->get();
    }
}
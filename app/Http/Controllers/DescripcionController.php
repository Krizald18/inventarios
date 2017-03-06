<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Descripcion;
use Response;

class DescripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Descripcion::orderBy('descripcion', 'asc')->get();
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

            $nextid = \DB::table('descripciones')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Descripcion;

            $j->id = $nextid;
            $j->descripcion = $o->descripcion;

            $j->save();

            return Descripcion::orderBy('descripcion', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Descripcion::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
    
    }

    public function destroy($id)
    {
        $obj = Descripcion::find($id);
        $obj->delete();

        return Descripcion::orderBy('descripcion', 'asc')->get();
    }
}
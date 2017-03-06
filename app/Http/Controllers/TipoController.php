<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Tipo::orderBy('tipo', 'asc')->get();
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

            $nextid = \DB::table('tipos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Tipo;

            $j->id = $nextid;
            $j->tipo = $o->tipo;

            $j->save();

            return Tipo::orderBy('tipo', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Tipo::find($id);
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
        $obj = Tipo::find($id);
        $obj->delete();

        return Tipo::orderBy('tipo', 'asc')->get();
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Responsable;

class ResponsableController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Responsable::orderBy('responsable', 'asc')->with('usuario')->get();
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

            return Responsable::orderBy('responsable', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Responsable::with('usuario')->find($id);
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

        return Responsable::orderBy('responsable', 'asc')->get();
    }
}
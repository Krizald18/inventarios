<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subgrupo;
use Response;

class SubgrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Subgrupo::with('grupo')->orderBy('subgrupo', 'asc')->get();
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

            $nextid = \DB::table('subgrupos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Subgrupo;

            $j->id = $nextid;
            $j->Subgrupo = $o->Subgrupo;

            $j->save();

            return Subgrupo::with('grupo')->orderBy('subgrupo', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Subgrupo::find($id);
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
        $obj = Subgrupo::find($id);
        $obj->delete();

        return Subgrupo::with('grupo')->orderBy('subgrupo', 'asc')->get();
    }
}
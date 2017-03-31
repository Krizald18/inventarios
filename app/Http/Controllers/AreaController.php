<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Area::orderBy('area', 'asc')->get();
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

            $nextid = \DB::table('areas')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Area;

            $j->id = $nextid;
            $j->area = $o->area;

            $j->save();

            return Area::orderBy('area', 'asc')->get();
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Area::find($id);
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
        $obj = Area::find($id);
        $obj->delete();

        return Area::orderBy('area', 'asc')->get();
    }
}
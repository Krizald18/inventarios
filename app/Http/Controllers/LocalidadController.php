<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Localidad;
use Response;

class LocalidadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index(Request $request)
    {
        if($request->has('municipio') && $request->has('search'))
        {
            $search = $request->search;
            $x = Localidad::with('municipio')
                ->where('municipio_id', '=', $request->municipio)
                ->where('localidad', 'LIKE', '%'.$search.'%')
                ->orderBy('localidad', 'asc')
                ->paginate(100);
        }
        else
        {
            $x = Localidad::with('municipio')
                ->orderBy('municipio_id', 'asc')
                ->orderBy('localidad', 'asc')
                ->paginate(10);
        }
        return Response::json($x, 300);
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
        return Localidad::with('municipio')->find($id);
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
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Oficialia;

class OficialiaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return Oficialia::with('municipio', 'responsable')->orderBy('id', 'asc')->get();
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
        return Oficialia::with('municipio', 'responsable')->find($id);
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
        $obj = Oficialia::find($id);
        $obj->delete();

        return Oficialia::with('municipio', 'responsable')->orderBy('id', 'asc')->get();
    }
}
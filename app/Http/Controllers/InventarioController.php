<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventario;
use Response;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        $x = Inventario::with('caracteristica')
                            ->orderBy('numero_inventario', 'asc')
                            ->orderBy('numero_serie', 'asc')
                            ->paginate(10);
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
        return Inventario::find($id);
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
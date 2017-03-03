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

    public function index(Request $request)
    {
        $desc = false;
        $order = 'numero_inventario';
        $limit = 5;
        if($request->has('order'))
        {
            if($request->order{0} == "-")
            {
                $order = substr($request->order, 1, strlen($request->order)-1);
                $desc = true;
            }
            if(strcmp($order,'numero_inventario') !== 0 && strcmp($order,'numero_serie') !== 0 && strcmp($order,'cantidad') !== 0 )
                $order = $order.'_id';
        }
        if($request->has('limit'))
            $limit = intval($request->limit);
        if($desc)
        {
            $x = Inventario::with('descripcion','caracteristica','tipo','marca','modelo','oficialia','municipio','municipio_fisico', 'localidad_fisica')
                        ->orderBy($order, 'desc')
                        ->paginate($limit);
        }
        else
        {
            $x = Inventario::with('descripcion','caracteristica','tipo','marca','modelo','oficialia','municipio','municipio_fisico', 'localidad_fisica')
                        ->orderBy($order, 'asc')
                        ->paginate($limit);
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
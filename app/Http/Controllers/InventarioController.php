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
        if($request->has('numero_inventario') && $request->has('numero_serie'))
        {
            $inventario = \DB::table('inventarios')
                     ->select(\DB::raw('count(*) as conteo'))
                     ->where('numero_inventario', '=', $request->numero_inventario)
                     ->orwhere('numero_serie', '=', $request->numero_serie)
                     ->get();
            $obj = (object) $inventario[0];
            return Response::json($obj->conteo,200);
        }
        else
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
                $x = Inventario::with('area', 'grupo', 'responsable', 'descripcion','caracteristica','tipo','marca','modelo','oficialia','municipio','municipio_fisico', 'localidad_fisica')
                            ->orderBy($order, 'desc')
                            ->paginate($limit);
            }
            else
            {
                $x = Inventario::with('area', 'grupo', 'responsable','descripcion','caracteristica','tipo','marca','modelo','oficialia','municipio','municipio_fisico', 'localidad_fisica')
                            ->orderBy($order, 'asc')
                            ->paginate($limit);
            }

            return Response::json($x, 300);
        }
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

            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Inventario;

            if(isset($o->area_id) && !is_null($o->area_id))
                $j->area_id = $o->area_id;
            
            $j->cantidad = $o->cantidad;
            
            if(isset($o->caracteristica_id) && !is_null($o->caracteristica_id))
                $j->caracteristica_id = $o->caracteristica_id;

            if(isset($o->descripcion_id) && !is_null($o->descripcion_id))
                $j->descripcion_id = $o->descripcion_id;

            if(isset($o->fecha_baja) && !is_null($o->fecha_baja))
                $j->fecha_baja = date('Y-m-d',strtotime($o->fecha_baja));

            if(isset($o->grupo_id) && !is_null($o->grupo_id))
                $j->grupo_id = $o->grupo_id;

            if(isset($o->marca_id) && !is_null($o->marca_id))
                $j->marca_id = $o->marca_id;

            if(isset($o->modelo_id) && !is_null($o->modelo_id))
                $j->modelo_id = $o->modelo_id;

            if(isset($o->municipio_fisico_id) && !is_null($o->municipio_fisico_id))
                $j->municipio_fisico_id = $o->municipio_fisico_id;

            if(isset($o->municipio_id) && !is_null($o->municipio_id))
                $j->municipio_id = $o->municipio_id;

            if(isset($o->localidad_fisica_id) && !is_null($o->localidad_fisica_id))
                $j->localidad_fisica_id = $o->localidad_fisica_id;

            if(isset($o->numero_inventario) && !is_null($o->numero_inventario))
                $j->numero_inventario = $o->numero_inventario;

            if(isset($o->numero_serie) && !is_null($o->numero_serie))
                $j->numero_serie = $o->numero_serie;

            if(isset($o->oficialia_id) && !is_null($o->oficialia_id))
            {
                if(strlen($o->oficialia_id) == 4)
                    $j->oficialia_id = "0".$o->oficialia_id;
                else
                    $j->oficialia_id = $o->oficialia_id;
            }

            if(isset($o->responsable_id) && !is_null($o->responsable_id))
                $j->responsable_id = $o->responsable_id;

            if(isset($o->tipo_id) && !is_null($o->tipo_id))
                $j->tipo_id = $o->tipo_id;
            
            $j->save();
            return self::show($j->id);
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Inventario::with('area', 'grupo', 'responsable','descripcion','caracteristica','tipo','marca','modelo','oficialia','municipio','municipio_fisico', 'localidad_fisica')->find($id);
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
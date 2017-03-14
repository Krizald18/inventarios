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
        {   // recive numero de serie y numero de inventario, regresa 1 si existe numero_inventario, 2 si existe numero_serie, 3 si existen los dos
            $inventario = \DB::table('inventarios')
                     ->select(\DB::raw('count(*) as response'))
                     ->where('numero_inventario', '=', $request->numero_inventario)
                     ->get();

            $serie = \DB::table('inventarios')
                     ->select(\DB::raw('count(*) as response'))
                     ->where('numero_serie', '=', $request->numero_serie)
                     ->get();

            $numero_inventario = (object) $inventario[0];
            $numero_serie = (object) $serie[0];

            $resp = (object) array('response' => 0);

            if($numero_inventario->response > 0)
                $resp->response = 1;

            if($numero_serie->response > 0) // 3 both
                $resp->response = $resp->response + 2;
            
            return Response::json($resp, 200);
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
                $x = Inventario::with('area', 'responsable')
                        ->with(array('oficialia' => function($q){
                            $q->with('municipio');
                        }))
                        ->with(array('modelo' => function($q){
                            $q->with('marca');
                            $q->with('caracteristica');
                            $q->with('subgrupo');
                        }))
                        ->orderBy($order, 'desc')
                        ->paginate($limit);
            }
            else
            {
                $x = Inventario::with('area', 'responsable')
                        ->with(array('oficialia' => function($q){
                            $q->with('municipio');
                        }))
                        ->with(array('modelo' => function($q){
                            $q->with('marca');
                            $q->with('caracteristica');
                            $q->with('subgrupo');
                        }))
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
            $j = new Inventario;

            if(isset($o->numero_inventario) && !is_null($o->numero_inventario))
                $j->numero_inventario = $o->numero_inventario;

            if(isset($o->numero_serie) && !is_null($o->numero_serie))
                $j->numero_serie = $o->numero_serie;

            if(isset($o->fecha_baja) && !is_null($o->fecha_baja))
                $j->fecha_baja = date('Y-m-d',strtotime($o->fecha_baja));

            if(isset($o->status) && !is_null($o->status))
                $j->status = $o->status;

            if(isset($o->modelo_id) && !is_null($o->modelo_id))
                $j->modelo_id = $o->modelo_id;

            if(isset($o->oficialia_id) && !is_null($o->oficialia_id))
                $j->oficialia_id = strlen($o->oficialia_id) == 4 ? "0".$o->oficialia_id : $o->oficialia_id;

            if(isset($o->area_id) && !is_null($o->area_id))
                $j->area_id = $o->area_id;

            if(isset($o->responsable_id) && !is_null($o->responsable_id))
                $j->responsable_id = $o->responsable_id;
            
            $j->save();
            return self::show($j->id);
        }
        else
            return $request;
    }

    public function show($id)
    {
        return Inventario::with('area', 'responsable')
                        ->with(array('oficialia' => function($q){
                            $q->with('municipio');
                        }))
                        ->with(array('modelo' => function($q){
                            $q->with('marca');
                            $q->with('caracteristica');
                            $q->with('subgrupo');
                        }))->find($id);
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
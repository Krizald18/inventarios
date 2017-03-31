<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventario;
use App\Resguardo;
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
            $txt = '';
            $searchby = 0;
            $limit = 5;
            $status = strval($request->input('status')) == 'true'? true: false;
           
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

            if($request->has('txt'))
                $txt = $request->txt;

            if($request->has('searchby'))
                $searchby = $request->searchby;

            if($desc)
            {
                if($searchby == 1) // solo por numero de serie, a Z - 0 9
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
                            ->where('numero_serie', $txt)
                            ->where('status', $status)
                            ->orderBy($order, 'desc')
                            ->paginate($limit);
                    return Response::json($x, 300);
                }
                if($searchby == 2) // serie o inventario, 0 9
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
                                ->where('numero_serie', $txt)
                                ->orwhere('numero_inventario', $txt)
                                ->where('status', $status)
                                ->orderBy($order, 'desc')
                                ->paginate($limit);
                        return Response::json($x, 300);
                    }
                    if($searchby == 3) // oficialia, responsable o serie, a Z
                    {
                        $a = Inventario::with('area', 'responsable')
                            ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                            ->with(array('modelo' => function($q){
                                $q->with('marca');
                                $q->with('caracteristica');
                                $q->with('subgrupo');
                            }))
                            ->where('numero_serie', $txt)
                            ->where('status', $status)
                            ->orderBy($order, 'desc')
                            ->paginate($limit);

                        if(count($a) == 1)
                            return Response::json($a, 300);

                        $x = Inventario::with('area', 'responsable')
                            ->with(array('modelo' => function($r){
                                $r->with('marca');
                                $r->with('caracteristica');
                                $r->with('subgrupo');
                            }))
                            ->with(array('oficialia' => function($o){
                                $o->with('municipio');
                            }))
                            ->whereHas('oficialia', function($q) use ($txt){
                                $q->where('oficialia', 'LIKE', '%'.$txt.'%');
                            })
                            ->orwhereHas('responsable', function($s) use ($txt){
                                $s->where('responsable', 'LIKE', '%'.$txt.'%');
                            })
                            ->where('status', $status)
                            ->orderBy($order, 'desc')
                            ->paginate($limit);

                        return Response::json($x, 300);
                    }
                    else
                        $x = Inventario::with('area', 'responsable')
                            ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                            ->with(array('modelo' => function($q){
                                $q->with('marca');
                                $q->with('caracteristica');
                                $q->with('subgrupo');
                            }))
                                ->where('status', $status)
                                ->orderBy($order, 'asc')
                                ->orderBy($order, 'desc')
                                ->paginate($limit);
                        return Response::json($x, 300);
            }
            else
            {
                if($searchby == 1) // solo por numero de serie
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
                            ->where('numero_serie', $txt)
                            ->where('status', $status)
                            ->orderBy($order)
                            ->paginate($limit);
                    return Response::json($x, 300);
                }
                if($searchby == 2) // serie o inventario
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
                            ->where('numero_serie', $txt)
                            ->orwhere('numero_inventario', $txt)
                            ->where('status', $status)
                            ->orderBy($order)
                            ->paginate($limit);
                    return Response::json($x, 300);
                }
                if($searchby == 3) // oficialia, responsable o serie
                {
                    $a = Inventario::with('area', 'responsable')
                        ->with(array('oficialia' => function($q){
                            $q->with('municipio');
                        }))
                        ->with(array('modelo' => function($q){
                            $q->with('marca');
                            $q->with('caracteristica');
                            $q->with('subgrupo');
                        }))
                        ->where('numero_serie', $txt)
                        ->where('status', $status)
                        ->orderBy($order)
                        ->paginate($limit);

                    if(count($a) == 1)
                        return Response::json($a, 300);

                    $x = Inventario::with('area', 'responsable')
                        ->with(array('modelo' => function($r){
                            $r->with('marca');
                            $r->with('caracteristica');
                            $r->with('subgrupo');
                        }))
                        ->with(array('oficialia' => function($o){
                            $o->with('municipio');
                        }))
                        ->whereHas('oficialia', function($q) use ($txt){
                            $q->where('oficialia', 'LIKE', '%'.$txt.'%');
                        })
                        ->orwhereHas('responsable', function($s) use ($txt){
                            $s->where('responsable', 'LIKE', '%'.$txt.'%');
                        })
                        ->where('status', $status)
                        ->orderBy($order)
                        ->paginate($limit);

                    return Response::json($x, 300);
                }
                else                    
                    $x = Inventario::with('area', 'responsable')
                        ->with(array('oficialia' => function($q){
                            $q->with('municipio');
                        }))
                        ->with(array('modelo' => function($q){
                            $q->with('marca');
                            $q->with('caracteristica');
                            $q->with('subgrupo');
                        }))
                            ->where('status', $status)
                            ->orderBy($order)
                            ->paginate($limit);
                    return Response::json($x, 300);
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
            {
                $j->responsable_id = $o->responsable_id;
                /*$res = Resguardo::where('responsable_id', $j->responsable_id)
                                ->where('status', 0)
                                ->orderBy('created_at', 'desc')
                                ->first();
                if(isset($res) && !is_null($res))
                {

                }
                else
                {
                    $res = new Resguardo;
                    $res->responsable_id = $j->responsable_id;
                }*/
            }        
            $j->save();
            //$res->articulos()->save($j);
            return self::show($j->id);
        }
        else if($request->has('command') && $request->input('command') == 'baja')
        {
            $ar = Inventario::find($request->input('id'));
            $ar->fecha_baja = date('Y-m-d',strtotime($request->input('fecha_baja')));
            $ar->comentario_baja = $request->input('comentario');
            $ar->status = false;
            $ar->resguardo_id = null; // sacar articulo de resguardos
            $ar->area_id = 5; // cambiar area a BODEGA
            $ar->responsable_id = 244; // cambiar responsable a Gobierno del Estado
            $ar->oficialia_id = null; // se quita de la oficialia
            $ar->save();
            return $ar;
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
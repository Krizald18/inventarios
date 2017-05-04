<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventario;
use Response;

class GraficaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }

    public function activos()
    {
    	$now = new \DateTime('now');
    	$mn = $now->format('m');
        $year = $now->format('Y');
        $enero = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '=', '01')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
        $febrero = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '02')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
        $marzo = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '03')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
        $abril = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '04')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
        $mayo = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '05')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$junio = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '06')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$julio = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '07')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$agosto = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '08')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$septiembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '09')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$octubre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '10')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$noviembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '11')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
		$diciembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '12')
                        ->whereYear('created_at', $year)
                        ->whereNull('fecha_baja')
                        ->get();
        $mn = intval($mn);
        $enero = $enero[0]->value == 0? null: $enero[0]->value;
        $febrero = $mn >= 2? ($febrero[0]->value == 0? null: $febrero[0]->value): null;
        $marzo = $mn >= 3? ($marzo[0]->value == 0? null: $marzo[0]->value): null;
        $abril = $mn >= 4? ($abril[0]->value == 0? null: $abril[0]->value): null;
        $mayo = $mn >= 5? ($mayo[0]->value == 0? null: $mayo[0]->value): null;
        $junio = $mn >= 6? ($junio[0]->value == 0? null: $junio[0]->value): null;
        $julio = $mn >= 7? ($julio[0]->value == 0? null: $julio[0]->value): null;
        $agosto = $mn >= 8? ($agosto[0]->value == 0? null: $agosto[0]->value): null;
        $septiembre = $mn >= 9? ($septiembre[0]->value == 0? null: $septiembre[0]->value): null;
        $octubre = $mn >= 10? ($octubre[0]->value == 0? null: $octubre[0]->value): null;
        $noviembre = $mn >= 11? ($noviembre[0]->value == 0? null: $noviembre[0]->value): null;
        $diciembre = $mn >= 12? ($diciembre[0]->value == 0? null: $diciembre[0]->value): null;

		$result=array_map(function($value){
		    return is_array($value) ? array("value"=>$value["value"]) : array("value"=>$value);
		}, compact('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'));
		return response()->success(array_values($result));
    }
    public function bajas()
    {
    	$now = new \DateTime('now');
    	$mn = $now->format('m');
        $year = $now->format('Y');
        $enero = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '=', '01')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
        $febrero = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '02')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
        $marzo = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '03')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
        $abril = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '04')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
        $mayo = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '05')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$junio = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '06')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$julio = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '07')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$agosto = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '08')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$septiembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '09')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$octubre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '10')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$noviembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '11')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
		$diciembre = \DB::table('inventarios')
                        ->select(\DB::raw('count(*) as value'))
                        ->whereMonth('created_at', '<=', '12')
                        ->whereYear('created_at', $year)
                        ->whereNotNull('fecha_baja')
                        ->get();
        $mn = intval($mn);
        $enero = $enero[0]->value == 0? null: $enero[0]->value;
        $febrero = $mn >= 2? ($febrero[0]->value == 0? null: $febrero[0]->value): null;
        $marzo = $mn >= 3? ($marzo[0]->value == 0? null: $marzo[0]->value): null;
        $abril = $mn >= 4? ($abril[0]->value == 0? null: $abril[0]->value): null;
        $mayo = $mn >= 5? ($mayo[0]->value == 0? null: $mayo[0]->value): null;
        $junio = $mn >= 6? ($junio[0]->value == 0? null: $junio[0]->value): null;
        $julio = $mn >= 7? ($julio[0]->value == 0? null: $julio[0]->value): null;
        $agosto = $mn >= 8? ($agosto[0]->value == 0? null: $agosto[0]->value): null;
        $septiembre = $mn >= 9? ($septiembre[0]->value == 0? null: $septiembre[0]->value): null;
        $octubre = $mn >= 10? ($octubre[0]->value == 0? null: $octubre[0]->value): null;
        $noviembre = $mn >= 11? ($noviembre[0]->value == 0? null: $noviembre[0]->value): null;
        $diciembre = $mn >= 12? ($diciembre[0]->value == 0? null: $diciembre[0]->value): null;        

		$result=array_map(function($value){
		    return is_array($value) ? array("value"=>$value["value"]) : array("value"=>$value);
		}, compact('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'));
		return response()->success(array_values($result));
    }
}

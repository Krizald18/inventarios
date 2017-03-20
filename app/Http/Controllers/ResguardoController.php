<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Resguardo;
use App\Inventario;
use App\Responsable;
use PDF;
use Response;
class ResguardoController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {
        return self::generate_pdf();
        return Resguardo::with('articulos')->get();
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
            $nextid = \DB::table('resguardos')->max('id');
            if(isset($nextid))
                $nextid = $nextid + 1;
            else
                $nextid = 1;

            $j = new Resguardo;
            $j->id = $nextid;
            $j->responsable_id = $o->responsable_id;
            $j->push();

            if(isset($o->articulos))
            {
                foreach ($o->articulos as $articulo) {
                    $i = Inventario::find($articulo);
                    $i->resguardo_id = $nextid;
                    $i->save();
                }
            }

            return Responsable::with('usuario', 'articulos_asignados')
                            ->with(array('resguardos' => function($q){
                                    $q->with(array('articulos' => function($a){
                                        $a->with(array('modelo' => function($q){
                                            $q->with('marca');
                                            $q->with('caracteristica');
                                            $q->with('subgrupo');
                                        }));
                                    }));
                                }))
                            ->with(array('articulos_asignados' => function($a){
                                $a->with(array('modelo' => function($q){
                                    $q->with('marca');
                                    $q->with('caracteristica');
                                    $q->with('subgrupo');
                                }));
                            }))
                            ->with(array('oficialia' => function($q){
                                $q->with('municipio');
                            }))
                            ->orderBy('responsable', 'asc')
                            ->find($j->responsable_id);
        }
        else if($request->has('pdf_data'))
            return self::generate_pdf($request);
        else
            return $request;
    }

    public function show($id)
    {
        return Resguardo::find($id);
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
        $obj = Resguardo::find($id);
        $obj->delete();

        return Resguardo::all();
    }

    function generate_pdf(Request $request) {
        $now = new \DateTime('now');
        $day = $now->format('d');
        $mn = $now->format('m');
        $year = $now->format('Y');
        switch (intval($mn)) {
            case 1:
                $month = "Enero";
                break;
            case 2:
                $month = "Febrero";
                break;
            case 3:
                $month = "Marzo";
                break;
            case 4:
                $month = "Abril";
                break;
            case 5:
                $month = "Mayo";
                break;
            case 6:
                $month = "Junio";
                break;
            case 7:
                $month = "Julio";
                break;
            case 8:
                $month = "Agosto";
                break;
            case 9:
                $month = "Septiembre";
                break;
            case 10:
                $month = "Octubre";
                break;
            case 11:
                $month = "Nobiembre";
                break;
            case 12:
                $month = "Diciembre";
                break;
        }
        $o = (object) $request->input('pdf_data');
        $articulos = $o->articulos;
        //dd($articulos);
        $data = [
            'id' => strval($year).( intval($o->id) < 100? ( intval($o->id) < 10? '00'.$o->id: '0'.$o->id ) : $o->id ),
            'articulos' => $articulos,
            'oficial' => $o->oficial,
            'oficialia' => $o->oficialia,
            'municipio' => $o->municipio,
            'estado' => 'SINALOA',
            'day' => $day,
            'month' => $month,
            'year' => $year
        ];

        $id = $o->id;

        if (!file_exists('pdfs/generados/pdf'.$id.'.pdf')) {
            $pdf = PDF::loadView('resguardo', $data);
            $pdf->save('pdfs/generados/pdf'.$id.'.pdf');
        }
        
        $file= public_path(). '/pdfs/generados/pdf'.$id.'.pdf';
        $pdfdata = file_get_contents($file);
        $base64 = base64_encode($pdfdata);
        
        return $base64;
    }
}
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
        $this->middleware(['cors', 'auth:api']);
    }

    public function index()
    {        
        return Resguardo::with('articulos', 'evidencias')->get();
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
            
            if(isset($o->set_note) && isset($o->id) && isset($o->nota))
            {
                $r = Resguardo::findOrFail($o->id);
                $r->observaciones = $o->nota;
                $r->save();
                return self::show($o->id);
            }

            $now = new \DateTime('now');
            $year = $now->format('Y');
            $j = new Resguardo;
            $j->responsable_id = $o->responsable_id;
            $j->push();

            $folio = 'RE-'.strval($year).( $j->id < 100? ( $j->id < 10? '00'.$j->id: '0'.$j->id ) : $j->id );
            $j->folio = $folio;
            $j->save();

            if(isset($o->articulos))
            {
                foreach ($o->articulos as $articulo) {
                    $i = Inventario::find($articulo);
                    $i->resguardo_id = $j->id;
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
        return Resguardo::with('articulos', 'evidencias')->find($id);
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
                $month = "Noviembre";
                break;
            case 12:
                $month = "Diciembre";
                break;
        }
        $o = (object) $request->input('pdf_data');
        $folio = 'RE-'.strval($year).( intval($o->id) < 100? ( intval($o->id) < 10? '00'.$o->id: '0'.$o->id ) : $o->id );
        $articulos = $o->articulos;
        $nota = isset($o->nota)? $o->nota: "";
        foreach ($articulos as $articulo) {
            $a = (object) $articulo;
            $inv = Inventario::find($a->id);
            $inv->folio_resguardo = $folio;
            $inv->save();
        }
        //dd($articulos);
        // de 21 en 21 por hoja
        $data = [
            'id' => $folio,
            'hojas' => array_chunk($articulos, 21),
            'oficial' => $o->oficial,
            'num_oficialia' => strlen(strval($o->num_oficialia)) < 5? '0'.strval($o->num_oficialia) : strval($o->num_oficialia),
            'oficialia' => $o->oficialia,
            'municipio' => $o->municipio,
            'estado' => 'SINALOA',
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'nota' => $nota
        ];

        $id = $o->id;

        if (!file_exists('pdfs/generados/'))
            mkdir('pdfs/generados/', 0777, true);

        if (file_exists('pdfs/generados/'.$folio.'.pdf')) 
            unlink('pdfs/generados/'.$folio.'.pdf');

        $pdf = PDF::loadView('resguardo', $data);
        $pdf->save('pdfs/generados/'.$folio.'.pdf');

        $resguardo = Resguardo::find($id);
        if(!$resguardo->pdf_generado)
        {
            $resguardo->pdf_generado = true;
            $resguardo->save();
        }
        
        $file = public_path().'/pdfs/generados/'.$folio.'.pdf';
        $pdfdata = file_get_contents($file);
        $base64 = base64_encode($pdfdata);
        
        return $base64;
    }
}
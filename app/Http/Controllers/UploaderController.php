<?php

namespace App\Http\Controllers;

use Storage;
use App\Resguardo;
use App\Evidencia;
use App\User;
use Response;
use Illuminate\Http\Request;

class UploaderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function uploadFile(Request $request, $id)
    {
    	if(!$request->has('uri'))
    		return 'sin uri';
        if(!$request->has('name'))
            return 'sin nombre de archivo';
        if(!$request->has('tipo_archivo'))
            return 'sin tipo de archivo';
    	if(!$request->hasFile('file'))
    		return 'sin archivo';
    	if(strval($request->tipo_archivo) == 'resguardo_firmado')
	    {
            $now = new \DateTime('now');
            $year = $now->format('Y');
            $folio = 'RE-'.strval($year).($id < 100? ( $id < 10? '00'.$id: '0'.$id ) : $id );            
		    $resguardo = Resguardo::findOrFail($id);
	        $resguardo->pdf_firmado = true;
	        $resguardo->save();
            
            $ev = Evidencia::where('resguardo_id', $id)->where('uri', $request->uri)->where('file', $request->name)->get();
            if(count($ev) == 0)
            {
                $e = new Evidencia;
                $e->resguardo_id = $id;
                $e->uri = $request->uri;
                $e->file = $request->name;
                $e->save();
            }
	    }
        if(isset($folio))
        {
            if(Storage::exists($request->uri.'/'.strval($request->name)))
                Storage::delete($request->uri.'/'.strval($request->name));
            Storage::put(
                $request->uri.'/'.strval($request->name),
                file_get_contents($request->file('file')->getRealPath())
            );

    	    if(strval($request->tipo_archivo) == 'resguardo_firmado')
            	return $resguardo;
            else
            	return 'done!';
        }
    }
    public function deleteFile(Request $request, $id)
    {
        // validar admin_token y user
        // recive un id de una evidencia, user (id) y  admin_token
        if(!$request->has('user') || !$request->has('admin_token'))
            return Response::json($request, 500);
        $u = User::with('admin')->find($request->user);

        if($u->admin->token <> $request->admin_token)
            return Response::json($request, 500);

        $e = Evidencia::findOrFail($id);
        $rid = $e->resguardo_id;

        if(Storage::exists($e->uri.'/'.$e->file))
            Storage::delete($e->uri.'/'.$e->file);
        $e->delete();
        $r = Resguardo::with('evidencias')->findOrFail($rid);
        if(count($r->evidencias) == 0)
        {
            $r->pdf_firmado = false;
            $r->save();
        }
        return $r;
    }
}
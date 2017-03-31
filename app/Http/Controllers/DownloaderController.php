<?php

namespace App\Http\Controllers;

use Storage;
use App\Resguardo;
use App\Evidencia;
use Illuminate\Http\Request;

class DownloaderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors', 'auth:api']);
    }
    public function donwloadFile(Request $request, $id)
    {
    	if(!$request->has('type'))
    		return 'sin tipo';
        if($request->type == 'resguardo')
        {
            // id es id de evidencia
            $e = Evidencia::findOrFail($id);

            if(!Storage::exists($e->uri.'/'.$e->file))
            	return $request;
    	    
    	    $file = Storage::get($e->uri.'/'.$e->file);
            $base64 = base64_encode($file);
    	    return $base64;
        }
        else
            return 'Not implemented';
    }
}
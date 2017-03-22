<?php

namespace App\Http\Controllers;

use Storage;
use App\Resguardo;
use Illuminate\Http\Request;

class UploaderController extends Controller
{
    public function uploadFile(Request $request, $id)
    {
    	if(!$request->has('folder'))
    		return 'sin folder';
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
	    }
        if(isset($folio))
        {
            if(Storage::exists($request->folder.'/'.strval($request->name)))
                Storage::delete($request->folder.'/'.strval($request->name));
            Storage::put(
                $request->folder.'/'.strval($request->name),
                file_get_contents($request->file('file')->getRealPath())
            );

    	    if(strval($request->tipo_archivo) == 'resguardo_firmado')
            	return $resguardo;
            else
            	return 'done!';
        }
    }
}
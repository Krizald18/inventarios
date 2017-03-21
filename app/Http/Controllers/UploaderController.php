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
    	if(!$request->hasFile('file'))
    		return 'sin archivo';

    	if(strval($request->folder) == 'resguardos_firmados')
	    {
		    $resguardo = Resguardo::findOrFail($id);
	        $resguardo->pdf_firmado = true;
	        $resguardo->save();
	    }

        if(!Storage::exists($request->folder.'/'.$id.'.pdf'))
	        Storage::put(
	            $request->folder.'/'.$resguardo->id.'.pdf',
	            file_get_contents($request->file('file')->getRealPath())
	        );

	    if(strval($request->folder) == 'resguardos_firmados')
        	return $resguardo;
        else
        	return 'done!';
    }
}
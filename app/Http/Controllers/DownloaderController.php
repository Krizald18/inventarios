<?php

namespace App\Http\Controllers;

use Storage;
use App\Resguardo;
use Illuminate\Http\Request;

class DownloaderController extends Controller
{
    public function donwloadFile(Request $request, $id)
    {
    	if(!$request->has('folder'))
    		return 'sin folder';

        if(!Storage::exists($request->folder.'/'.$id.'.pdf'))
        	return $request;
	    
	    $file = Storage::get($request->folder.'/'.$id.'.pdf');
        $base64 = base64_encode($file);
	    return $base64;
    }
}
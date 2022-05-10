<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class StaticFileController extends Controller
{
    //
    public function attachment($attachment,$name,$id,$file){
        $storagePath = storage_path($attachment.'/'.$name.'/'.$id.'/'.$file);
        $mimeType = mime_content_type($storagePath);

        if( ! \File::exists($storagePath)){
            return view('errorpages.404');
        }
        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$file.'"'
        );
        return Response::make(file_get_contents($storagePath), 200, $headers);
    }
	 public function loanattachment($upload,$id,$file){
        $storagePath = storage_path($upload.'/'.$id.'/'.$file);
        $mimeType = mime_content_type($storagePath);

        if( ! \File::exists($storagePath)){
            return view('errorpages.404');
        }
        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.$file.'"'
        );
        return Response::make(file_get_contents($storagePath), 200, $headers);
    }
}

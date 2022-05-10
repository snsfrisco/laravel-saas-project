<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpacesAPI\Spaces;

class DigitalOceanController extends Controller
{

    public $space="";
    function __construct()
    {
        $spaces = new Spaces(env('DIGITAL_KEY'), env('DIGITAL_SECRET'),env('DIGITAL_REGION'));
        $this->space = $spaces->space(env('DIGITAL_SPACE'));

    }

    public function FileUpload($tmp_file,$file_name,$member_customer_id,$client_id,$type){
        $imageName = $file_name;
        $destination_path=env('DIGITAL_PARENT').'/'.$client_id.'/'.$type.'/'.$member_customer_id.'/'.$imageName;
        $space=$this->space;
        $file_upload=$space->uploadFile($tmp_file,$destination_path);
        $file_upload->makePublic();
        $file_url = $file_upload->getURL();
        return $file_url;
    }
}

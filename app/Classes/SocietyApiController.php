<?php

namespace App\Classes;

$path = 'https://nidhi.snssystem.com/nidhi/control/memberListByApp';

class SocietyApiController
{

    public $end_point_url;

    function __construct( $end_point_url){
        $this->end_point_url = $end_point_url;

    }



    public function getApi($module)
    {

        $path =  $this->end_point_url .''. $module;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}

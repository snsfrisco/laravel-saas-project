<?php
namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller as Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class BaseController extends Controller
{


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function states()
    {
        $states=array();
        foreach(config('states') as $key=>$val){
            $states[] = [
                'key' => $key,
                'value' => $val
            ];
        }
        return $this->sendResponse( $states, 'States List');
    }
    public function branches()
    {
       $branch= auth()->user()->client->branches;
        $branches=array();
        foreach($branch as $key=>$val){
            $branches[] = [
                'key' => $val->id,
                'value' => $val->branch_name
            ];
        }
        return $this->sendResponse( $branches, 'Branches List');
    }
    public function goldrate(){
        $gold=Configuration::where('key','metal-api')->first();
        return $this->sendResponse( json_decode($gold->value), 'Gold Rate XAU');
    }
    public function client_branches()
    {
        return $this->sendResponse(auth()->user()->client->branches, 'Branches List');
    }
    public function client_regions()
    {
        return $this->sendResponse(auth()->user()->client->regions, 'Regions List');
    }
    public function client_zones()
    {
        return $this->sendResponse(auth()->user()->client->zones, 'Zones List');
    }

    public function client_profile()
    {
        return $this->sendResponse(auth()->user(), 'User Profile');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAttachment;
use App\Models\Member;
use App\Models\MemberAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AutoCompleteController extends Controller
{
   public function index(){

   }
   public function getmemberdetail(Request $request){
       $memberid=$request->id;
       $type=$request->type;
       if($type=="member"){
        $resp = Member::find($memberid);
        $profile=MemberAttachment::where('member_id',$memberid)->where('attachment_type','profile_image')->first();
        $profile_image="";
        if($profile){
            $profile_image=URL::to('/').'/'.$profile->attachment_path;
        }
        $resp->profile=$profile_image;
        $resp->current_address = $resp->current_address;
       }else{
        $resp = Customer::find($memberid);
        $profile=CustomerAttachment::where('customer_id',$memberid)->where('attachment_type','profile_image')->first();
		$profile_image="";
        if($profile){
            $profile_image=URL::to('/').'/'.$profile->attachment_path;
        }
        $resp->profile=$profile_image;
        $resp->current_address = $resp->current_address;

       }
    //$array=array('id'=>$id,'type'=>$type);
    echo json_encode($resp);
    die();

   }
   public function autocomplete(Request $request)
    {
        $loanForType=$request->loanForType;
        $search=$request->member;
        if($loanForType=="member"){
            $res = Member::with('loans')->select("id","first_name","last_name","middle_name")
            ->whereRaw("concat(first_name, ' ',middle_name, ' ', last_name) like '%" .$search. "%' ")
                ->get();
        }else{
            $res = Customer::with('loans')->select("id","first_name","last_name","middle_name")
            ->whereRaw("concat(first_name, ' ',middle_name, ' ', last_name) like '%" .$search. "%' ")
                ->get();

        }
        $html="";
        if($res->count()>0){
            $html .="<ul>";
            foreach($res as $resp){
                $html .='<li data-id="'.$resp->id.'">'.$resp->first_name.' '.$resp->last_name.'</li>';
            }
            $html .="<ul>";
        }
        $array=["resp"=>$res,'html'=>$html];
        echo json_encode($array);
        die();
    }
}

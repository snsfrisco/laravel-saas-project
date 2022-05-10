<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Client\API\BaseController;
use App\Http\Controllers\DigitalOceanController;
use App\Models\Branch;
use App\Models\Member;
use App\Models\MemberAddress;
use App\Models\MemberAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Str;
use Illuminate\Support\Facades\Log;
// use App\ConcreteClasses\Clients\IClient;

class ManageMembersAPIController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $members = auth()->user()->getClient()->getMembers();
        return $this->sendResponse( $members, 'Members Retrived Successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response=json_decode($request->all()['data']);

        $responseArr=[];
        if(isset($response->member)){
            $customer=(array) $response->member;
            $customerobj=$response->member;
            $member = Arr::except($customer,['permanent_address', 'current_address', 'office_address','pan_card','adhar_card_front','adhar_card_back','profile_image','customer_signature_image']);
            $member['registration_date']=date('Y-m-d',strtotime($customerobj->registration_date));
            $member['date_of_birth']=date('Y-m-d',strtotime($customerobj->date_of_birth));
            $member['nominee_date_of_birth']=date('Y-m-d',strtotime($customerobj->nominee_date_of_birth));
            $member['branch_id']=$customerobj->branch_id;
            $customerdata=Member::create($member);
            $responseArr['member'] = $customerdata;
            if(isset($response->permanent_address)){

                $permanent_address = (array) $response->permanent_address;
                $permanent_address['member_id']=$customerdata->id;
                $permanent_address['address_type']='permanent_address';
                $responseArr['permanent_address'] = MemberAddress::create($permanent_address);

            }
            if(isset($response->current_address)){
                $current_address= (array) $request->current_address;
                $current_address['member_id']=$customerdata->id;
                $current_address['address_type']='current_address';
                $responseArr['current_address'] = MemberAddress::create($current_address);
            }

            if(!empty($_FILES)){

                $storage_path=storage_path('attachment/');
                $lockPath= $folderPath=$storage_path.'/members/'.$customerdata->id.'/';
                if (!file_exists($lockPath)) {
                    mkdir($lockPath, 0777, true);
                    $folderPath=$lockPath;
                }else{
                    $folderPath=$lockPath;
                }
                if(!empty($_FILES['profile_image'])){
                    $file=$_FILES['profile_image'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $short_path='attachment/'.'members/'.$customerdata->id.'/'.$imageName;
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );

                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['profile_image'] =  MemberAttachment::updateOrCreate(["member_id"=>$customerdata->id,"attachment_type"=>"profile_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"profile_image","aws_path"=>$aws_upload]);
                    }

                }
                if(!empty($_FILES['customer_signature'])){
                    $file=$_FILES['customer_signature'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );

                    $short_path='attachment/'.'members/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['member_signature_image'] = MemberAttachment::updateOrCreate(["member_id"=>$customerdata->id,"attachment_type"=>"member_signature_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"member_signature_image","aws_path"=>$aws_upload]);
                    }

                }
                if(!empty($_FILES['pan_card'])){
                    $file=$_FILES['pan_card'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['pan_card'] = MemberAttachment::updateOrCreate(["member_id"=>$customerdata->id,"attachment_type"=>"pan_card"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"pan_card","aws_path"=>$aws_upload]);
                    }


                }
                if(!empty($_FILES['adhar_card_front'])){
                    $file=$_FILES['adhar_card_front'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_front'] = MemberAttachment::updateOrCreate(["member_id"=>$customerdata->id,"attachment_type"=>"adhar_card_front"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_front","aws_path"=>$aws_upload]);

                    }

                }
                if(!empty($_FILES['adhar_card_back'])){
                    $file=$_FILES['adhar_card_back'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_back'] = MemberAttachment::updateOrCreate(["member_id"=>$customerdata->id,"attachment_type"=>"adhar_card_back"],
                ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_back","aws_path"=>$aws_upload]);
                    }

                }

            }


            return $this->sendResponse( $responseArr, 'Member Successfully Created');
        }else{

            return $this->sendResponse( $responseArr, 'Something went wrong plz try again !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return response($member->toArray() , 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
	
		Log::info('FILES = ', [$_FILES]);
        $response=json_decode($request->all()['data']);
        $responseArr=[];
        if(isset($response->member)){
            $customer=(array) $response->member;
            $customerobj=$response->member;
            $members = Arr::except($customer,['permanent_address', 'current_address', 'office_address','pan_card','adhar_card_front','adhar_card_back','profile_image','customer_signature_image']);
            $members['registration_date']=date('Y-m-d',strtotime($customerobj->registration_date));
            $members['date_of_birth']=date('Y-m-d',strtotime($customerobj->date_of_birth));
            $members['nominee_date_of_birth']=date('Y-m-d',strtotime($customerobj->nominee_date_of_birth));
            $member['branch_id']=$customerobj->branch_id;
			$customerdata=$member->update($members);
            //$customerdata=Member::create($member);
			$addresses = $member->addresses;
			$permanentaddress = $addresses->where('address_type', 'permanent_address') ? $addresses->where('address_type', 'permanent_address')->first() : null;
			$currentaddress = $addresses->where('address_type', 'current_address') ? $addresses->where('address_type', 'current_address')->first() : null;
			$officeaddress = $addresses->where('address_type', 'office_address') ? $addresses->where('address_type', 'office_address')->first() : null;

            $responseArr['member'] = $customerdata;
            if(isset($response->permanent_address)){
				 if($permanentaddress){
					$permanent_address = (array) $response->permanent_address;
					$permanent_address['member_id']=$member->id;
					$permanent_address['address_type']='permanent_address';
					$responseArr['permanent_address']= $permanentaddress->update($permanent_address);
				 }else{
					$permanent_address = (array) $response->permanent_address;
					$permanent_address['member_id']=$member->id;
					$permanent_address['address_type']='permanent_address';
					$responseArr['permanent_address'] = MemberAddress::create($permanent_address);
				 }

            }
            if(isset($response->current_address)){
				if($currentaddress){
					$current_address= (array) $request->current_address;
					$current_address['member_id']=$member->id;
					$current_address['address_type']='current_address';
					$responseArr['current_address']= $currentaddress->update($current_address);

				}else{
					$current_address= (array) $request->current_address;
					$current_address['member_id']=$member->id;
					$current_address['address_type']='current_address';
					$responseArr['current_address'] = MemberAddress::create($current_address);
				}
            }

            if(!empty($_FILES)){

                $storage_path=storage_path('attachment/');
                $lockPath= $folderPath=$storage_path.'/members/'.$member->id.'/';
                if (!file_exists($lockPath)) {
                    mkdir($lockPath, 0777, true);
                    $folderPath=$lockPath;
                }else{
                    $folderPath=$lockPath;
                }
                if(!empty($_FILES['profile_image'])){
                    $file=$_FILES['profile_image'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $short_path='attachment/'.'members/'.$member->id.'/'.$imageName;
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$member->id,Auth::user()->client_id,'members'
                    );

                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['profile_image'] =  MemberAttachment::updateOrCreate(["member_id"=>$member->id,"attachment_type"=>"profile_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"profile_image","aws_path"=>$aws_upload]);
                    }

                }
                if(!empty($_FILES['customer_signature'])){
                    $file=$_FILES['customer_signature'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$member->id,Auth::user()->client_id,'members'
                    );

                    $short_path='attachment/'.'members/'.$member->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['member_signature_image'] = MemberAttachment::updateOrCreate(["member_id"=>$member->id,"attachment_type"=>"member_signature_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"member_signature_image","aws_path"=>$aws_upload]);
                    }

                }
                if(!empty($_FILES['pan_card'])){
                    $file=$_FILES['pan_card'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$member->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$member->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['pan_card'] = MemberAttachment::updateOrCreate(["member_id"=>$member->id,"attachment_type"=>"pan_card"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"pan_card","aws_path"=>$aws_upload]);
                    }


                }
                if(!empty($_FILES['adhar_card_front'])){
                    $file=$_FILES['adhar_card_front'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$member->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$member->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_front'] = MemberAttachment::updateOrCreate(["member_id"=>$member->id,"attachment_type"=>"adhar_card_front"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_front","aws_path"=>$aws_upload]);

                    }

                }
                if(!empty($_FILES['adhar_card_back'])){
                    $file=$_FILES['adhar_card_back'];
                    $target_file = $folderPath . basename($file["name"]);
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imageName = uniqid() . '.'.$extension;
                    $upcPath=$folderPath.$imageName;
                    $Tmpfile=$file['tmp_name'];
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$member->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'members/'.$member->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_back'] = MemberAttachment::updateOrCreate(["member_id"=>$member->id,"attachment_type"=>"adhar_card_back"],
                ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_back","aws_path"=>$aws_upload]);
                    }

                }

            }


            return $this->sendResponse( $responseArr, 'Member Successfully Updated');
        }else{

            return $this->sendResponse( $responseArr, 'Something went wrong plz try again !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member=Member::find($id);
        $member->delete();
        return response([
            'message' => 'Member Successfully Deleted'
        ], 200);
    }

    public function search(Branch $branch, $param)
    {
        $numeric_param = is_numeric($param) ? $param : 0;
        $client_id = auth()->user()->client_id;
        $members = Member::with('addresses','attachments','loans')
        // ->whereHas('branch', function($branch) use ($client_id){
        //     $branch->where('client_id', $client_id);
        // })
        ->where('branch_id', $branch->id)
        ->where(function($query) use ($param, $numeric_param) {
            $query->where('id', $numeric_param)
            ->orWhere('first_name', 'like', "%{$param}%")
            ->orWhere('middle_name', 'like', "%{$param}%")
            ->orWhere('last_name', 'like', "%{$param}%");
        })
        ->get();

        return $this->sendResponse( $members, 'Members Searched');
    }

    public function generate_loan_account_no(Member $member)
    {
        return $this->sendResponse( ['loan_account_no' => $member->generate_loan_account_no() ], 'Loan Account No Generated');
    }

}

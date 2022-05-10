<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Client\API\BaseController;
use App\Http\Controllers\DigitalOceanController;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Str;

class ManageCustomersAPIController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = auth()->user()->client->customers;
        return $this->sendResponse( $customers, 'Customers Retrived Successfully');
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
        if(isset($response->customer)){
            $customer=(array) $response->customer;
            $customerobj=$response->customer;
            $customer = Arr::except($customer,['permanent_address', 'current_address', 'office_address','pan_card','adhar_card_front','adhar_card_back','profile_image','customer_signature_image']);
            $customer['registration_date']=date('Y-m-d',strtotime($customerobj->registration_date));
            $customer['date_of_birth']=date('Y-m-d',strtotime($customerobj->date_of_birth));
            $customer['nominee_date_of_birth']=date('Y-m-d',strtotime($customerobj->nominee_date_of_birth));
            $customer['client_id']=Auth::user()->client_id;
            $customerdata=Customer::create($customer);
            $responseArr['customer'] = $customerdata;
            if(isset($response->permanent_address)){

                $permanent_address = (array) $response->permanent_address;
                $permanent_address['customer_id']=$customerdata->id;
                $permanent_address['address_type']='permanent_address';
                $responseArr['permanent_address'] = CustomerAddress::create($permanent_address);

            }
            if(isset($response->current_address)){
                $current_address= (array) $request->current_address;
                $current_address['customer_id']=$customerdata->id;
                $current_address['address_type']='current_address';
                $responseArr['current_address'] = CustomerAddress::create($current_address);
            }

            if(!empty($_FILES)){

                $storage_path=storage_path('attachment/');
                $lockPath= $folderPath=$storage_path.'/customers/'.$customerdata->id.'/';
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
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customerdata->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['profile_image'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customerdata->id,"attachment_type"=>"profile_image"],
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
                    $short_path='attachment/'.'customers/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['customer_signature_image'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customerdata->id,"attachment_type"=>"customer_signature_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"customer_signature_image","aws_path"=>$aws_upload]);
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
                    $short_path='attachment/'.'customers/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['pan_card'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customerdata->id,"attachment_type"=>"pan_card"],
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
                    $short_path='attachment/'.'customers/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_front'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customerdata->id,"attachment_type"=>"adhar_card_front"],
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
                    $short_path='attachment/'.'customers/'.$customerdata->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_back'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customerdata->id,"attachment_type"=>"adhar_card_back"],
                ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_back","aws_path"=>$aws_upload]);
                    }

                }

            }


            return $this->sendResponse( $responseArr, 'Customer Successfully Created');
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
    public function show(Customer $customer)
    {

	  return response($customer->toArray() , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
		$response=json_decode($request->all()['data']);
        $responseArr=[];
        if(isset($response->customer)){
            $custome=(array) $response->customer;
            $customerobj=$response->customer;
            $customers = Arr::except($custome,['permanent_address', 'current_address', 'office_address','pan_card','adhar_card_front','adhar_card_back','profile_image','customer_signature_image']);
            $customers['registration_date']=date('Y-m-d',strtotime($customerobj->registration_date));
            $customers['date_of_birth']=date('Y-m-d',strtotime($customerobj->date_of_birth));
            $customers['nominee_date_of_birth']=date('Y-m-d',strtotime($customerobj->nominee_date_of_birth));
            $customers['client_id']=Auth::user()->client_id;
			$customerdata=$customer->update($customers);
			$addresses = $customer->addresses;
			$permanentaddress = $addresses->where('address_type', 'permanent_address') ? $addresses->where('address_type', 'permanent_address')->first() : null;
			$currentaddress = $addresses->where('address_type', 'current_address') ? $addresses->where('address_type', 'current_address')->first() : null;
			$officeaddress = $addresses->where('address_type', 'office_address') ? $addresses->where('address_type', 'office_address')->first() : null;
            //$customerdata=Customer::create($customer);
            $responseArr['customer'] = $customerdata;
            if(isset($response->permanent_address)){
				if($permanentaddress){
					$permanent_address = (array) $response->permanent_address;
					$permanent_address['customer_id']=$customer->id;
					$permanent_address['address_type']='permanent_address';
					$permanentaddress->update($permanent_address);
				}else{
					$permanent_address = (array) $response->permanent_address;
					$permanent_address['customer_id']=$customer->id;
					$permanent_address['address_type']='permanent_address';
					$responseArr['permanent_address'] = CustomerAddress::create($permanent_address);
				}

            }
            if(isset($response->current_address)){
				if($currentaddress){
					$current_address= (array) $request->current_address;
					$current_address['customer_id']=$customer->id;
					$current_address['address_type']='current_address';
					$currentaddress->update($current_address);
				}else{
					$current_address= (array) $request->current_address;
					$current_address['customer_id']=$customer->id;
					$current_address['address_type']='current_address';
					$responseArr['current_address'] = CustomerAddress::create($current_address);
				}
            }

            if(!empty($_FILES)){

                $storage_path=storage_path('attachment/');
                $lockPath= $folderPath=$storage_path.'/customers/'.$customer->id.'/';
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
                    $digital=new DigitalOceanController();
                    $aws_upload=$digital->FileUpload(
                        $Tmpfile,$imageName,$customer->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customer->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['profile_image'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customer->id,"attachment_type"=>"profile_image"],
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
                        $Tmpfile,$imageName,$customer->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customer->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['customer_signature_image'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customer->id,"attachment_type"=>"customer_signature_image"],
                        ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"customer_signature_image","aws_path"=>$aws_upload]);
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
                        $Tmpfile,$imageName,$customer->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customer->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['pan_card'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customer->id,"attachment_type"=>"pan_card"],
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
                        $Tmpfile,$imageName,$customer->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customer->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_front'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customer->id,"attachment_type"=>"adhar_card_front"],
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
                        $Tmpfile,$imageName,$customer->id,Auth::user()->client_id,'members'
                    );
                    $short_path='attachment/'.'customers/'.$customer->id.'/'.$imageName;
                    if (move_uploaded_file($Tmpfile, $upcPath)) {
                        $responseArr['adhar_card_back'] = CustomerAttachment::updateOrCreate(["customer_id"=>$customer->id,"attachment_type"=>"adhar_card_back"],
                ['attachment_name'=>$imageName,"attachment_path"=>$short_path,"attachment_type"=>"adhar_card_back","aws_path"=>$aws_upload]);
                    }

                }

            }


            return $this->sendResponse( $responseArr, 'Customer Successfully Updated');
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
        return redirect()->route('client_user.customers.index')->with('success', 'Customer Successfully deleted');
    }


    public function search($param)
    {
        $numeric_param = is_numeric($param) ? $param : 0;
        $client_id = auth()->user()->client_id;
        $customers = Customer::with('addresses','attachments','loans')
        ->where('client_id', auth()->user()->client_id)
        ->where(function($query) use ($param, $numeric_param) {
            $query->where('id', $numeric_param)
            ->orWhere('first_name', 'like', "%{$param}%")
            ->orWhere('middle_name', 'like', "%{$param}%")
            ->orWhere('last_name', 'like', "%{$param}%");
        })
        ->get();

        return $this->sendResponse( $customers, 'Customers Searched');
    }

    public function generate_loan_account_no(Customer $customer)
    {
        return $this->sendResponse( ['loan_account_no' => $customer->generate_loan_account_no() ], 'Loan Account No Generated');
    }

}

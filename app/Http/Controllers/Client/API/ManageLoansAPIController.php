<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Client\API\BaseController;
use App\Models\Branch;
use App\Models\Configuration;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Str;

class ManageLoansAPIController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loans = Loan::with('branch', 'emis', 'loaneable', 'loaneable.attachments')->where('client_id', auth()->user()->client_id)->orderBy('created_at', 'DESC')->get();
        return $this->sendResponse( $loans, 'Loans Retrived Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'image_path.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        $data = request()->all();
        $loan = new Loan();
        $loan->client_id         = auth()->user()->client_id;
        $loan->branch_id         = $request->branchId;
        $loan->customer_type     = $request->loanForType;
        $loan->loaneable_id      = $request->loaneable_id;
        $loan->loaneable_type    = ($request->loanForType == 'customer') ? 'App\\Models\\Customer' : 'App\\Models\\Member' ;
        $loan->loan_type         = $request->LOAN_TYPE;
        $loan->loan_period       = $request->LOAN_PERIOD;
        $loan->loan_period_month = $request->LOAN_PERIOD_MONTH;
        $loan->annual_int_rate   = $request->annualIntRate;
        $loan->loan_amount       = $request->Loan_Amount;
        $loan->emi_type          = $request->EMI_TYPE;
        $loan->emi               = $request->emi;
        $loan->introAgentId      = $request->agentId;
        $loan->security_deposit  = $request->security_deposit;
        $loan->gold_description  = $request->gold_description;
        $loan->gold_weight       = $request->gold_weight;
        $loan->gold_worth        = $request->gold_worth;
        $loan->account_no        = $request->memberCode;
        $loan->loan              = $request->LOAN;
        $loan->downPayment       = $request->downPayment;
        $loan->upFrontProfit     = $request->upFrontProfit;
        $loan->created_by        = auth()->user()->id;
        $loan->save();

        if($request->hasfile('image_path')) {
            foreach($request->file('image_path') as $file)
            {
                $name = $file->getClientOriginalName();
                 $folderPath=storage_path().'/uploads/'.$loan->id.'/';
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $path='/uploads/'.$loan->id.'/'.$name;
                $file->move($folderPath, $name);
                $imgData[] = $path;
            }
            $loan->image_path=$imgData;
            $loan->save();
        }
        return $this->sendResponse( $loan, 'Loan Successfully Created');
        // return response([
        //     'loan' => $loan,
        //     'message' => 'Loan Successfully Created'
        // ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return response($loan->toArray() , 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //dd($loan);
        // dd($request->all());
        $request->validate([
            'image_path.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        $loan->branch_id         = isset($request->branch_id) ? $request->branch_id : $loan->branch_id ;
        $loan->customer_type     = isset($request->customer_type) ? $request->customer_type : $loan->customer_type ;
        $loan->loaneable_id      = isset($request->loaneable_id) ? $request->loaneable_id : $loan->loaneable_id ;
        $loan->loaneable_type    = isset($request->customer_type) ? ( $request->customer_type == 'customer' ? 'App\\Models\\Customer' : 'App\\Models\\Member' ) : $loan->loaneable_type ;
        $loan->loan_type         = isset($request->loan_type) ? $request->loan_type : $loan->loan_type ;
        $loan->loan_period       = isset($request->loan_period) ? $request->loan_period : $loan->loan_period ;
        $loan->loan_period_month = isset($request->loan_period_month) ? $request->loan_period_month : $loan->loan_period_month ;
        $loan->annual_int_rate   = isset($request->annual_int_rate) ? $request->annual_int_rate : $loan->annual_int_rate ;
        $loan->loan_amount       = isset($request->loan_amount) ? $request->loan_amount : $loan->loan_amount ;
        $loan->emi_type          = isset($request->emi_type) ? $request->emi_type : $loan->emi_type ;
        $loan->emi               = isset($request->emi) ? $request->emi : $loan->emi ;
        $loan->introAgentId      = isset($request->introAgentId) ? $request->introAgentId : $loan->introAgentId ;
        $loan->security_deposit  = isset($request->security_deposit) ? $request->security_deposit : $loan->security_deposit ;
        $loan->gold_description  = isset($request->gold_description) ? $request->gold_description : $loan->gold_description ;
        $loan->gold_weight       = isset($request->gold_weight) ? $request->gold_weight : $loan->gold_weight ;
        $loan->gold_worth        = isset($request->gold_worth) ? $request->gold_worth : $loan->gold_worth ;
        $loan->account_no        = isset($request->account_no) ? $request->account_no : $loan->account_no ;
        // $loan->loan              = isset($request->loan) ? $request->loan : $loan->loan ;
        $loan->downPayment       = isset($request->downPayment) ? $request->downPayment : $loan->downPayment ;
        $loan->upFrontProfit     = isset($request->upFrontProfit) ? $request->upFrontProfit : $loan->upFrontProfit ;
        $loan->updated_by        = auth()->user()->id;
        $loan->save();
        if($request->hasfile('image_path')) {
            foreach($request->file('image_path') as $file)
            {
                //$name = $file->getClientOriginalName();
                $extension =  $file->clientExtension();
                $name = uniqid() . '.'.$extension;
                 $folderPath=storage_path().'/uploads/'.$loan->id.'/';
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $path='/uploads/'.$loan->id.'/'.$name;
                $file->move($folderPath, $name);
                $imgData[] = $path;
            }
            $loan->image_path=$imgData;
            $loan->save();
        }
        return $this->sendResponse( $loan, 'Loan Successfully Updated');
       // return response($loan->toArray() , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('client_user.loans.index')->with('success', 'Customer Successfully deleted');
    }

    public function update_loan_status(Request $request, Loan $loan)
    {
        $loan->notes = $request->note;
        $loan->loan_status = $request->loan_status;
        $loan->save();
        return $this->sendResponse( $loan, 'Loan Successfully '.($request->loan_status == 1 ? 'Approved' : 'Rejected'));
    }

    public function confirm_disburse_loan_form(Request $request, Loan $loan)
    {
        $loan_status = $request->loan_status;
        return view('client_user.loans._confirm_disburse_loan_form', compact('loan', 'loan_status'));
    }
    public function confirm_disburse_loan(Request $request, Loan $loan)
    {
        $emis = $loan->generateEmis();
        return response([
            'status' => 'success',
            'message' => 'Loan Successfully Disbursed and EMIs generated',
            'emis' => $emis
        ], 200);
    }

    public function popup_emis(Loan $loan)
    {
        return view('client_user.loans._popup_emis', compact('loan'));
    }

    public function loan_emis(Loan $loan){

        return $this->sendResponse( $loan->emis, 'Loan EMIS Successfully Retrieved');
    }



}

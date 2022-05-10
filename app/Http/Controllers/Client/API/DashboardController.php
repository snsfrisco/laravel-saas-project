<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Client\API\BaseController;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{

    public function dashboard()
    {
        $loans = Loan::with('branch', 'emis', 'loaneable')->where('client_id', auth()->user()->client_id)->get();
        $pending_loans = $loans->filter(function ($loan){
            return is_null($loan->loan_status);
        });
        $approved_loans = $loans->filter(function ($loan){
            return $loan->loan_status && $loan->emis->count() < 1;
        });
        $rejected_loans = $loans->filter(function ($loan){
            return ! $loan->loan_status &&  ! is_null($loan->loan_status);
        });
        $disbursed_loans = $loans->filter(function ($loan){
            return $loan->loan_status && $loan->emis->count() > 0;
        });
        /* return response ( [
            'pending_loans' => $pending_loans,
            'approved_loans' => $approved_loans,
            'rejected_loans' => $rejected_loans,
            'disbursed_loans' => $disbursed_loans], 200); */

        $data = [
            'members' => auth()->user()->getClient()->getMembers()->count(),
            'customers' => auth()->user()->client->customers->count(),
            'pending_loans' => $pending_loans->count(),
            'approved_loans' => $approved_loans->count(),
            'rejected_loans' => $rejected_loans->count(),
            'disbursed_loans' => $disbursed_loans->count()
        ];
        return $this->sendResponse( $data, 'User Dashboard');
    }

}

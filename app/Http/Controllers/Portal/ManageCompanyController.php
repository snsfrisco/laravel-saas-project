<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;

class ManageCompanyController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            // $roles = Company::whereNull('level_id')->whereNull('level_type');
            return DataTables::of(Company::with('created_by_user')->get())
            ->addIndexColumn()
            ->setRowClass(function ($company) {
                return $company->active ? '' : 'text-muted';
            })
             ->addColumn('created_by_user_full_name',function($user){
                return $user->created_by_user->full_name;
            })
            /*->addColumn('roles',function($user){
                return '';
                return view('admin.users._roles',compact('user'));
            })
            ->addColumn('active_cb',function($user){
                return view('portal_user.users._active_cb',compact('user'));
            }) */
            ->addColumn('action',function($company){
                return view('portal_user.companies._action',compact('company'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('portal_user.companies.index');
    }

    public function create(Request $request)
    {
        $company = false;
        return view('portal_user.companies.create', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
        ]);
        $company = Company::create([
            'name' => $request->name,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('portal_user.companies.edit', $company->id)->with(['success' => 'Successfully Created.']);
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request, Company $company)
    {
        return view('portal_user.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => "required|unique:companies,name,{$company->id}",
        ]);

        $company->name = $request->name;
        $company->updated_by = auth()->id();
        $company->save();

        return redirect()->back()->with(['success' => 'Successfully Updated.']);
    }

    public function destroy(Request $request)
    {

    }
}

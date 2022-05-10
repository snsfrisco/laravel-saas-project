<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use DataTables;

class ManageCompanyAdminsController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $company_admins = CompanyUser::with('company')->orderBy('company_id');
            return DataTables::of($company_admins)
            ->addIndexColumn()
            ->setRowClass(function ($company_user) {
                return $company_user->active ? '' : 'text-muted';
            })
            ->addColumn('name',function($user){
                return $user->full_name;
            })
            ->addColumn('created_by_user_full_name',function($user){
                return $user->created_by->full_name;
            })
            /*->addColumn('roles',function($user){
                return '';
                return view('admin.users._roles',compact('user'));
            })*/
            ->addColumn('active_cb',function($user){
                return view('portal_user.companies-admins._active_cb',compact('user'));
            })
            ->addColumn('action',function($company_user){
                return view('portal_user.companies-admins._action',compact('company_user'));
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
        }
        return view('portal_user.companies-admins.index');
    }

    public function create(Request $request, Company $company)
    {
        $companies = Company::all();
        $company_admin = false;
        return view('portal_user.companies-admins.create', compact('companies', 'company_admin'));
    }

    public function store(Request $request, Company $company)
    {
        $request->validate([
            'company_id' => 'required',
            'email' => 'required|unique:company_users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:8|max:30'
        ]);

        $form_data = $request->input();
        $form_data['password'] = bcrypt($request->password);
        $form_data['created_by_id'] = auth()->id();
        $form_data['created_by_type'] = 'App\\Models\\PortalUser';

        $company_admin = CompanyUser::create($form_data);

        $company_admin->assignRole('Company Admin');

        return redirect()->route('portal_user.companies-admins.edit', $company_admin->id)->with(['success' => 'Successfully Created.']);
    }

    public function show(Request $request, CompanyUser $company_admin)
    {

    }

    public function edit(Request $request, CompanyUser $companies_admin)
    {
        $company_admin = $companies_admin;
        $companies = Company::all();
        return view('portal_user.companies-admins.edit', compact('companies', 'company_admin'));
    }

    public function update(Request $request, CompanyUser $companies_admin)
    {
        $company_admin = $companies_admin;
        $request->validate([
            'company_id' => 'required',
            'email' => "required|unique:company_users,email,{$company_admin->id}",
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $company_admin->company_id = $request->company_id;
        $company_admin->email = $request->email;
        if($request->password !== $company_admin->password){
            $company_admin->password = bcrypt($request->password);
        }
        $company_admin->first_name = $request->first_name;
        $company_admin->middle_name = $request->middle_name;
        $company_admin->last_name = $request->last_name;
        $company_admin->updated_by_id = auth()->id();
        $company_admin->updated_by_type = 'App\\Models\\PortalUser';
        $company_admin->save();

        return redirect()->back()->with(['success' => 'Successfully Updated.']);
    }

    public function destroy(Request $request, Company $company)
    {

    }
}

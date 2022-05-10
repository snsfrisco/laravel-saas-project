<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Portal\PortalbaseController;
use Illuminate\Http\Request;

use App\Models\PortalUser;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use DataTables;

class PortalUserController extends PortalbaseController
{
    public $module_dir = "users";
    public $module_route_prefix = "users";

    function check(Request $request)
    {
        // dd($request);
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:portal_users,email',
            'password' => 'required|min:8|max:50'
        ], [
            'email.exists' => 'This email does not exist',
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('portal_user')->attempt($creds)) {
            return redirect()->route('portal_user.dashboard');
        } else {
            return redirect()->route('portal_user.login')->with('fail', 'Incorrect credentials');
        }
    }

    function logout()
    {
        Auth::guard('portal_user')->logout();
        return redirect()->route('portal_user.login');
    }


    public function index(Request $request)
    {
        if($request->ajax()){
            $users = PortalUser::whereNotIn('id', [1]);
            return DataTables::of($users)
            ->addIndexColumn()
            ->setRowClass(function ($user) {
                return $user->active ? '' : 'text-muted';
            })
            ->addColumn('name',function($user){
                return $user->full_name;
            })
            ->addColumn('roles',function($user){
                return '';
                return view('admin.users._roles',compact('user'));
            })
            ->addColumn('active_cb',function($user){
                return view('portal_user.users._active_cb',compact('user'));
            })
            ->addColumn('action',function($user){
                return view('portal_user.users._action',compact('user'));
            })
            ->rawColumns(['roles', 'active_cb', 'action'])
            ->make(true);
        }
        return view('portal_user.users.index');
    }

    public function create(Request $request)
    {
        $user_roles_ids_arr = [];
        $roles = Role::whereNotIn('id', [1,2,3])->whereNull('roleable_id')->get();
        $user = false;
        return view('portal_user.users.create', compact('user', 'roles', 'user_roles_ids_arr'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:portal_users',
            'password' => 'required|min:8|max:30'
        ]);

        $user = PortalUser::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_by' => auth()->id()
        ]);

        if(!empty($request->role_id)){
            $user->assignRole(Role::find($request->role_id));
        }

        return redirect()->route('portal_user.users.index')->with('success', 'User Successfully Created');

    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request, PortalUser $user)
    {
        $user_roles = $user->roles;
        $user_roles_ids_arr = $user_roles && $user_roles->count() > 0 ? $user_roles->pluck('id')->toArray() : array();
        $roles = Role::whereNotIn('id', [1,2,3])->whereNull('roleable_id')->get();
        return view('portal_user.users.edit', compact('user', 'roles', 'user_roles_ids_arr'));
    }

    public function update(Request $request, PortalUser $user)
    {
        // $role = Role::find($request->role_id);

        // dd($user->roles);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|unique:portal_users,email,{$user->id}",
            'password' => 'required|min:8'
        ]);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password !== $user->password){
            $user->password = bcrypt($request->password);
        }
        $user->updated_by = auth()->id();
        $user->save();

        if(empty($request->role_id)){
            $user->syncRoles([]);
        }else{
            $roles = Role::whereIn('id', [$request->role_id])->get();
            $user->syncRoles($roles);
        }


        return redirect()->route('portal_user.users.index')->with('success', 'User Successfully Created');

    }

    public function destroy(Request $request)
    {

    }



}

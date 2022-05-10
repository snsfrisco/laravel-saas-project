<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientUser;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClientUserController extends Controller
{
    function check(Request $request)
    {
        // dd($request);
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:client_users,email',
            'password' => 'required|min:8|max:50'
        ], [
            'email.exists' => 'This email does not exist',
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('client_user')->attempt($creds)) {
            return redirect()->route('client_user.dashboard');
        } else {
            return redirect()->route('client_user.login')->with('fail', 'Incorrect credentials');
        }
    }


	public function show($id)
    {
        $clientUser = ClientUser::where('client_id',$id)->get();
		return view('client_user.users',compact('clientUser'));
    }


    function logout()
    {
        Auth::guard('client_user')->logout();
        return redirect()->route('client_user.login');
    }

    public function index(Request $request)
    {
        // dd(auth()->user()->client->roles);
        // dd(auth()->user()->client->roles->first()->permissions->toArray());
        if($request->ajax()){
            $users = ClientUser::where('client_id', auth()->user()->client_id);
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
                // return view('admin.users._roles',compact('user'));
            })
            ->addColumn('active_cb',function($user){
                return view('client_user.users._active_cb',compact('user'));
            })
            ->addColumn('action',function($user){
                return view('client_user.users._action',compact('user'));
            })
            ->rawColumns(['roles', 'active_cb', 'action'])
            ->make(true);
        }
        return view('client_user.users.index');
    }

    public function create(Request $request)
    {
        $user_roles_ids_arr = [];
        // $roles = Role::whereNotIn('id', [1,2,3])->where('roleable_id')->get();
        $roles = auth()->user()->client->roles;
        $user = false;
        return view('client_user.users.create', compact('user', 'roles', 'user_roles_ids_arr'));
    }

    function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:client_users',
            'password' => 'required|min:8|max:30'
        ]);

        $user = ClientUser::create([
            'client_id' => auth()->user()->client_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_by_id' => auth()->id(),
            'created_by_type' => 'App\\Models\\ClientUser'
        ]);

        if(!empty($request->role_id)){
            $user->assignRole(Role::find($request->role_id));
        }

        return redirect()->route('client_user.users.index')->with('success', 'User Successfully Created');
    }

    public function edit(Request $request, ClientUser $user)
    {
        $user_roles = $user->roles;
        $user_roles_ids_arr = $user_roles && $user_roles->count() > 0 ? $user_roles->pluck('id')->toArray() : array();
        $roles = auth()->user()->client->roles;
        return view('client_user.users.edit', compact('user', 'roles', 'user_roles_ids_arr'));
    }

    public function update(Request $request, ClientUser $user)
    {
        // dd($request);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|unique:client_users,email,{$user->id}",
            'password' => 'required|min:8'
        ]);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password !== $user->password){
            $user->password = bcrypt($request->password);
        }
        $user->updated_by_id = auth()->id();
        $user->updated_by_type = 'App\\Models\\ClientUser';
        $user->save();

        if(isset($request->role_id)){
            if(empty($request->role_id)){
                $user->syncRoles([]);
            }else{
                $roles = Role::whereIn('id', [$request->role_id])->get();
                $user->syncRoles($roles);
            }
        }

        return redirect()->route('client_user.users.index')->with('success', 'User Successfully Created');
    }
}

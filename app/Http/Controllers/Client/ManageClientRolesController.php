<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\ClientbaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class ManageClientRolesController extends ClientbaseController
{
    public $module_dir = "roles";
    public $module_route_prefix = "roles";

    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::of(auth()->user()->client->roles)
                ->addIndexColumn()
                ->addColumn('action',function($role){
                    return $this->mv('_action', compact('role'));
                })
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }
        return $this->mv('index');
    }

    public function create(Request $request)
    {
        $role_permissions = [];
        $modules = Module::where('app_level', $this->app_level)->get();
        return $this->mv('create', compact('modules','role_permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->where(function( $query ) use ($request) {
                    return $query->whereName($request->name)
                                ->whereGuardName($this->level_guard);
                })
            ]
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $this->level_guard,
            'roleable_id' => auth()->user()->client_id,
            'roleable_type' => 'App\\Models\\Client'
        ]);

        if(isset($request->permissions)){
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->givePermissionTo($permissions);
        }

        return redirect()->route($this->route_prefix.'index')->with('success', 'Role Successfully Created');
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request, Role $role)
    {
        $role_permissions = $role->permissions->pluck('id')->toArray();//dd($role, $role_permissions);
        $modules = Module::where('app_level', $this->app_level)->get();
        return $this->mv('edit', compact('role', 'modules', 'role_permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // dump($role->permissions, $request->all());
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->where(function( $query ) use ($request, $role) {
                    return $query->whereName($request->name)
                                ->whereGuardName($this->level_guard)
                                ->whereNotIn('id', [$role->id]);
                })
            ]
        ]);

        $role->name = $request->name;
        $role->save();

        $role->revokePermissionTo($role->permissions);

        if(count($request->permissions)){
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->givePermissionTo($permissions);
        }

        return redirect()->route($this->route_prefix.'index')->with('success', 'Role Successfully Updated');
    }

    public function destroy(Request $request)
    {

    }
}

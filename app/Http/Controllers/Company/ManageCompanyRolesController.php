<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Company\CompanybaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Module;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class ManageCompanyRolesController extends CompanybaseController
{
    public $module_dir = "roles";
    public $module_route_prefix = "roles";

    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::of(auth()->user()->company->roles)
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
        $company = auth()->user()->company;
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->where(function( $query ) use ($request, $company) {
                    return $query
                            ->where('name', $request->name)
                            ->where('roleable_id', $company->id)
                            ->where('roleable_type', 'App\\Models\\Company')
                            ->where('guard_name', $this->level_guard);
                })
            ]
        ]);

        // dd($validated);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $this->level_guard,
            'roleable_id' => auth()->user()->company_id,
            'roleable_type' => 'App\\Models\\Company'
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
        $company = auth()->user()->company;
        // dump($role->permissions, $request->all());
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->where(function( $query ) use ($request, $role, $company) {
                    return $query
                            ->whereNotIn('id', [$role->id])
                            ->where('name', $request->name)
                            ->where('roleable_id', $company->id)
                            ->where('roleable_type', 'App\\Models\\Company')
                            ->where('guard_name', $this->level_guard);
                })
            ]
        ]);

        $role->name = $request->name;
        $role->save();

        $role->revokePermissionTo($role->permissions);

        if(isset($request->permissions)){
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->givePermissionTo($permissions);
        }

        return redirect()->route($this->route_prefix.'index')->with('success', 'Role Successfully Updated');
    }

    public function destroy(Request $request)
    {

    }
}

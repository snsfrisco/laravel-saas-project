<style>
    #modules_row .card-body {
        height: 150px;
        max-height: 150px;
        overflow-y: auto;
    }
	.error{
	color:red;
	}
</style>


<div class="row">
    <div class="col-lg-12">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Role Name
                </span>
            </div>
            <input type="text"
                    class="form-control"
                    placeholder="{{ __('Enter Role Name') }}"
                    name="name"
                    value="{{isset($role) ? $role->name : ''}}"
                 required>
        </div>

        {{-- <div  class="form-group validate-input @if ($errors->has('role_name')) error-validation @endif">
            <label>{{__('Name')}}</label>
            <input type="text" class="form-control form-control-sm" name="name" placeholder="{{__('Role Name')}}" @if(isset($role))
                value="{{$role['name']}}" @endif required>

        </div> --}}
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Permissions')}}
                </h5>

                <button type="button" class="btn btn-danger btn-sm deselect_all_modules float-right">
                    <i class="fa fa-times-circle"></i>
                </button>

                <button type="button" class="btn btn-primary btn-sm select_all_modules float-right mr-2">
                    <i class="fa fa-check-square"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="row" id="modules_row">
                    @foreach($modules as $module)
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title">{{$module['module_name']}}</h5>
                                <button type="button" class="btn btn-danger btn-sm deselect_module float-right">
                                    <i class="fa fa-times-circle"></i>
                                </button>

                                <button type="button" class="btn btn-primary btn-sm  select_module float-right mr-2">
                                    <i class="fas fa-check-square"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                @foreach($module['permissions'] as $permission)
                                <div class="row">
                                    <div class="col-lg-9">
                                        <label for="{{$permission['key']}}">{{$permission['name']}}</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="switch">
                                            <input  type="checkbox"
                                                    name="permissions[]"
                                                    value="{{$permission['id']}}"
                                                    {{in_array($permission['id'], $role_permissions)? 'checked' : ''}}
                                            />
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

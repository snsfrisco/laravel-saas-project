<div class="row">
    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
            </div>
            <input  type="text"
                    class="form-control form-control-sm"
                    placeholder="{{ __('First Name') }}"
                    name="first_name"
                    value="{{ $user ? $user->first_name : '' }}"
                    required
            />
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
            </div>
            <input  type="text"
                    class="form-control form-control-sm"
                    placeholder="{{ __('Middle Name') }}"
                    name="middle_name"
                    value="{{ $user ? $user->middle_name : '' }}"
            />
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
            </div>
            <input  type="text"
                    class="form-control form-control-sm"
                    placeholder="{{ __('Last Name') }}"
                    name="last_name"
                    value="{{ $user ? $user->last_name : '' }}"
                    required
            />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>
            <input  type="email"
                    class="form-control form-control-sm"
                    placeholder="{{ __('Email Address') }}"
                    name="email"
                    value="{{ $user ? $user->email : '' }}"
                    required
            />
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </span>
            </div>
            <input  type="password"
                    class="form-control form-control-sm"
                    placeholder="{{ __('Password') }}"
                    name="password"
                    value="{{ $user ? $user->password : '' }}"
                    required>
        </div>
    </div>

    @if( \Request::route()->getName() == "client_user.users.create" || ! $user->hasRole('Client Admin'))
        <div class="col-sm-4">
            <div class="input-group form-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                    </span>
                </div>
                <select name="role_id" id="companies" class="form-control form-control-sm" placeholder="{{ __('Select Company') }}">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}"
                            {{ in_array($role->id, $user_roles_ids_arr) ? 'selected' : '' }}
                        >{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
</div>



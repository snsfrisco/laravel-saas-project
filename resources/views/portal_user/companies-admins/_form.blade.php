<div class="row">
    <div class="col-sm-4">
        <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-building" aria-hidden="true"></i>
                </span>
            </div>
            <select name="company_id" id="companies" class="form-control form-control-sm" placeholder="{{ __('Select Company') }}" required>
                <option value="">Select Company</option>
                @foreach ($companies as $company)
                    <option {{ $company_admin ? ($company->id == $company_admin->company_id ? 'selected' : '') : '' }}
                        value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
                    value="{{ $company_admin ? $company_admin->email : '' }}"
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
                    value="{{ $company_admin ? $company_admin->password : '' }}"
                    required>
        </div>
    </div>
</div>
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
                    value="{{ $company_admin ? $company_admin->first_name : '' }}"
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
                    value="{{ $company_admin ? $company_admin->middle_name : '' }}"
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
                    value="{{ $company_admin ? $company_admin->last_name : '' }}"
                    required
            />
        </div>
    </div>
</div>



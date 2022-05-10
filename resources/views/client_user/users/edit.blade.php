@extends('client_user.layouts.app')

@section('title')
{{ __('Edit User') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{url('css/select2.css')}}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('client_user.users.index') }}">{{ __('Users') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Edit User') }}</li>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit User') }}</h3>
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{route('client_user.users.update',$user['id'])}}">
            @csrf
            @method('put')
            <input type="hidden" id="user_roles" value="{{$user['roles']}}">
            <div class="card-body">
                <div class="col-lg-12">
                    @include('client_user.users._form')
                </div>
            </div>
            <div class="card-footer">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-check"></i>  {{__('Save')}}
                    </button>
                    <a href="{{ route('client_user.users.index') }}" class="btn btn-sm btn-danger">Close</a>
                </div>
            </div>
        </form>

        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script src="{{url('js/admin/users.js')}}"></script>
    {{-- @include('admin.users._common-js') --}}
@endsection

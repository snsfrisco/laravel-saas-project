@extends($level_views_dir.'.layouts.app')

@section('title'){{ __('Create Role') }}@endsection

@section('css')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route($route_prefix.'index') }}">{{ __('Roles') }}</a>
    <li class="breadcrumb-item active">Create Role</li>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create Role') }}</h3>
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{route($route_prefix.'store')}}">
        @csrf
            <div class="card-body">
                <div class="col-lg-12">
                    @include($dirpath.'_form')
                </div>
            </div>
            <div class="card-footer">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i>
                        {{ __('Save') }}
                    </button>
                    <a href="{{ route($route_prefix.'index') }}" class="btn btn-danger" >Close</a>
                </div>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
@include($dirpath.'_form_common_js')
@endsection

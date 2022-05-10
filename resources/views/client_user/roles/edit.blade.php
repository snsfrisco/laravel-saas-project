@extends($level_views_dir.'.layouts.app')

@section('title')
    {{ __('Edit Role') }}
@endsection

@section('css')
 <link rel="stylesheet" href="{{url('css/select2.css')}}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route($route_prefix.'index') }}">{{ __('Roles') }}</a>
    <li class="breadcrumb-item active">{{ __('Edit Role') }}</li>
@endsection


@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Edit Role') }}</h3>
        </div>
        <!-- /.card-header -->
        <form method="POST" action="{{route($route_prefix.'update',$role['id'])}}">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="col-lg-12">
                    @include($dirpath.'_form')
                </div>
            </div>
            <div class="card-footer">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-check"></i>
                        {{__('Save')}}
                    </button>
                </div>
            </div>
        </form>

        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script src="{{url('js/admin/roles.js')}}"></script>
    @include($dirpath.'_form_common_js')
@endsection

@extends('portal_user.layouts.app')





@section('styles')

@endsection





@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal_user.companies.index') }}">{{ __('Companies') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Add Company Form') }}</li>
                    </ol>
                </div>
                {{-- <div class="col-sm-6">
                    <a href="{{ route('sites.create') }}" class="btn btn-sm btn-primary float-sm-right">{{ __('+ Add Site') }}</a>
                </div> --}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Add New Company') }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">

                    <form action="{{route('portal_user.companies.store')}}" method="post">
                        @csrf
                        @include('portal_user.companies._form')
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>


                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: block;">
                    {{-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about the plugin. --}}
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection





@section('scripts')

@endsection

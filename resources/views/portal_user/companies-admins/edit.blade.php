@extends('portal_user.layouts.app')

@section('title')
{{ __('Edit Company Admin') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{url('css/select2.css')}}">
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('portal_user.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('portal_user.companies-admins.index') }}">{{ __('Companies Admins') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Edit Company Admin') }}</li>
                    </ol>
                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <form method="POST" action="{{ route('portal_user.companies-admins.update', $company_admin->id) }}">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Edit Company Admin') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    @csrf
                                    @method('put')
                                    @include('portal_user.companies-admins._form')
                            </div>
                            <div class="card-footer">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-check"></i> {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('portal_user.companies-admins.index') }}" class="btn btn-sm btn-danger">Close</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

@endsection

@extends('portal_user.layouts.app')

@section('title') {{ __('Users') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route($level_route_prefix.'.dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Users') }}</li>
@endsection

@section('add-model-button')
    {{-- @can('create_user') --}}
        <a href="{{ route('portal_user.users.create') }}" class="btn btn-primary btn-sm float-right">
            <i class="fa fa-plus"></i> {{ __('Add User') }}
        </a>
    {{-- @endcan --}}
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Users') }}</h3>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-striped table-hover table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Roles')}}</th>
                        <th>{{__('Active')}}</th>
                        <th>{{__('Created At')}}</th>
                        <th>{{__('Updated At')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {
            $('#data-table').DataTable({
                processing: true,
                language: { processing: datatable_processing_overlay},
                serverSide: true,
                scrollX: true,
                scrollY: 300,
                fixedHeader: true,
                stateSave: true,
                ajax: "{{route('portal_user.users.index')}}",
                columns: [
                    {data:"DT_RowIndex", sortable: false},
                    {data:"name"},
					{data:"email"},
					{data:"roles"},
					{data:"active_cb", sortable: false},
                    {data:"created_at"},
                    {data:"updated_at"},
                    {data:"action"}
                ]
            });
        });
        $(document).ready(function() {

        });
    </script>
@endsection

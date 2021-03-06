@extends('company_user.layouts.app')

@section('title') {{ __('Users') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="">Roles And Users</a></li>
    <li class="breadcrumb-item active">Users</li>
    {{-- <li class="breadcrumb-item"><a href="{{ route($level_route_prefix.'.dashboard') }}">{{ __('Dashboard') }}</a></li> --}}
@endsection

@section('add-model-button')
    {{-- @can('create_user') --}}
        <a href="{{ route('company_user.users.create') }}" class="btn btn-primary btn-sm float-right">
            <i class="fa fa-plus"></i> {{ __('Add User') }}
        </a>
    {{-- @endcan --}}
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">{{ __('Users') }}
            <button type="button" class="btn btn-primary btn-xs text-xs ml-3" data-toggle="collapse" data-target="#filter_div" aria-expanded="false" aria-controls="filter_div" id="filter_btn" title="Filter">
                <i class="fa fa-filter"></i> <span id="filter_txt">Show</span>
            </button>
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 collapse" id="filter_div">
                @php
                    $from_date = isset($_GET["sh_from_date"]) ? date("m/d/Y",strtotime($_GET["sh_from_date"])) : date("m/d/Y");
                    $to_date = isset($_GET["sh_to_date"]) ? date("m/d/Y",strtotime($_GET["sh_to_date"])) : date("m/d/Y") ;
                @endphp

                <form method="get" class="form-inline" id="sh_dashboard_filter_form">
                    <label for="from_date">From Date:&nbsp;</label>
                    <div class="form-group pr-2">
                        <input type="text" name="sh_from_date" id="sh_from_date"
                        class="form-control dates form-control-sm"
                        value="{{ $from_date }}" autocomplete="off"
                        required>
                    </div>
                    <label for="to_date">To Date:&nbsp;</label>
                    <div class="form-group">
                        <input type="text" name="sh_to_date" id="sh_to_date"
                        class="form-control form-control-sm dates"
                        value="{{ $to_date }}" data-inputmask-alias="date" autocomplete="off"
                        required>
                    </div>
                    <div class="form-group px-2">
                        <button type="submit" class="btn btn-primary btn-sm px-2 mx-1">Search</button>
                        <a href="/admin/home" type="reset" class="btn btn-danger btn-sm px-2 mx-1">Reset</a>
                    </div>
                </form>
                <p class="my-3 border-bottom">
            </div>
            <div class="col-lg-12">

                <div class="col-12 table-responsive">
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
        </div>
        <!-- /.row -->
    </div>
    <div class="card-footer">

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
                ajax: "{{route('company_user.users.index')}}",
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

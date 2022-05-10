@extends($level_views_dir.'.layouts.app')

@section('title')
    {{ __('Roles') }}
@endsection

<style>
    #roles_table_filter {
        text-align: right !important;
    }

    #roles_table_filter label {
        text-align: left !important;
    }

</style>

@section('breadcrumb')
    {{-- <li class="breadcrumb-item"><a href="{{ route($level_route_prefix.'.dashboard') }}">{{ __('Dashboard') }}</a></li> --}}
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('add-model-button')
    {{-- @can('create_role') --}}
    <a href="{{ route($route_prefix.'create') }}" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> {{ __('Create') }}
    </a>
    {{-- @endcan --}}
@endsection

@section('content')


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Roles Table') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="data_table" class="table table-striped table-hover table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>{{ __('Role Name') }}</th>
                                        <th width="150px">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

@endsection

@section('scripts')
    <script>
        $(function() {
            $('#data_table').DataTable({
                processing: true,
                language: { processing: datatable_processing_overlay},
                serverSide: true,
                ajax: '{!! route($route_prefix.'index') !!}',
                columns: [
                    {data:"DT_RowIndex", sortable: false},
                    { data: 'name', name: 'name' },
                    // { data: 'created_by_user_full_name'},
                    // { data: 'created_at', name: 'created_at' },
                    // { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
@endsection

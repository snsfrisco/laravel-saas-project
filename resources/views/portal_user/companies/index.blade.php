@extends('portal_user.layouts.app')

@section('title') {{ __('Companies') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('portal_user.dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Companies') }}</li>
@endsection

@section('add-model-button')
    @can('create_company')
        <a href="{{ route('portal_user.companies.create') }}" class="btn btn-sm btn-primary float-sm-right">{{ __('+ Add Company') }}</a>
    @endcan
@endsection

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Companies') }}</h3>

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
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer" style="display: block;">
            {{-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin. --}}
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
                ajax: '{!! route('portal_user.companies.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_by_user_full_name'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
	<style>
</style>
@endsection

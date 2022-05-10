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
                        <li class="breadcrumb-item"><a href="{{ route('portal_user.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal_user.companies.index') }}">{{ __('Companies') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Edit Company Form') }}</li>
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

            <form action="{{route('portal_user.companies.update', $company->id)}}" method="post">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit Company') }}</h3>

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
                    <div class="card-body">
                        @csrf
                        @method('put')
                        @include('portal_user.companies._form')
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="display: block;">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        {{-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about the plugin. --}}
                    </div>
                </div>
            </form>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection





@section('scripts')
    <script>
        $(function() {
            $('#data-table').DataTable({
                processing: true,
                language: { processing: datatable_processing_overlay},
                serverSide: true,
                scrollX: true,
                scrollY: 400,
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

@extends('company_user.layouts.app')

@section('title') {{ __('Clients') }} @endsection

<style>
    .form-inline span { display: none !important; }
    .btn-cl {
        box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        background-color: #d5b535 !important;
        color: white !important;
    }
</style>

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('company_user.dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Clients') }}</li>
@endsection

@section('add-model-button')
    @can('create_client')
        <a href="{{route('company_user.clients.create')}}" style="margin:0 5px;" id="addClient" class="btn btn-sm btn-primary float-sm-right">{{ __('Add Client') }}</a>
    @endcan
@endsection

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{ __('Clients') }}</h3>
        </div>
        <div class="card-body">
            <table id="reports_table" class="table table-striped table-hover table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th width="100px">{{ __('Name') }}</th>
                        <th width="50px">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!count($clients))
                        <tr class="nosort">
                            <td colspan="3" class="text-center">
                                {{__('No data available')}}
                            </td>
                        </tr>
                    @else
                        @foreach ($clients as $i=>$client)
                            <tr class="odd">
                                <td>{{$i+1}}</td>
                                <td>{{isset($client->name)?$client->name:''}}</td>
                                <td>
                                    <a href="{{ route('company_user.clients.edit', [$client->id]) }}"> <i class="fa fa-edit title="Edit client"></i></a>
                                    <a href="{{ route('company_user.clients.show', [$client->id]) }}"> <i class="fas btn btn-cl fa-angle-double-right" title="User's List"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('company_user.clients.modals.add_client')
@endsection

@section('scripts')
    <script>
		/*$(document).on('click', '#addClient', function() {
           $('#add_client_model').modal('toggle');
		});*/
    </script>

<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
@endsection

@extends('company_user.layouts.app')

@section('title') {{ __('Clients') }} @endsection

@section('content')

    <style>
        .form-inline span {
            display: none !important;
        }
		.btn-cl {
			box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
			background-color: #d5b535 !important;
			color: white !important;
		}
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$clients->name}} {{ __('Users') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
				{{-- <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Filter By Booking Dates By:
                        </div>
                        @php
                            $from_date = isset($_GET["sh_from_date"]) ? date("m/d/Y",strtotime($_GET["sh_from_date"])) : date("m/d/Y");
                            $to_date = isset($_GET["sh_to_date"]) ? date("m/d/Y",strtotime($_GET["sh_to_date"])) : date("m/d/Y") ;
                        @endphp
                        <div class="card-body">
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
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-sm-12">
									  <a href="{{route('company_user.client-user',$clients->id)}}" style="margin:0 5px;" id="addClient"
											class="btn btn-sm btn-primary float-sm-right">{{ __('Add User') }}</a>
								</div>
							</div>
						</div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12 table-responsive">
									<table id="reports_table" class="table table-striped table-hover table-bordered" width="100%">
										<thead>
											<tr>
												<th width="10px">#</th>
												<th width="100px">{{ __('Name') }}</th>
												<th width="50px">{{ __('Action') }}</th>
											</tr>
										</thead>
										<tbody>
											@if(!count($client_user))
												<tr class="nosort">
													<td colspan="3" class="text-center">
														{{__('No data available')}}
													</td>
												</tr>
											@else
												@foreach ($client_user as $i=>$client)
													<tr class="odd">
														<td>{{$i+1}}</td>
														<td>{{isset($client->first_name)?$client->first_name:''}} {{isset($client->middle_name)?$client->middle_name:''}} {{isset($client->last_name)?$client->last_name:''}}</td>
														<td>
                                                            <a href="{{ route('company_user.client-edit', [$client->id]) }}"> <i class="fa fa-edit title="Edit client"></i></a>
                                                            <form method="POST" action="{{route('company_user.client-destroy',$client->id)}}"  class="d-inline">
                                                                @csrf
                                                                    <input type="hidden" name="_method" value="delete">
                                                                    <button type="submit" class="btn btn-danger btn-sm delete_user" data-toggle="tooltip" data-placement="left" title="Delete Company">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                        </td>
													</tr>
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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

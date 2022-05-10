@extends('company_user.layouts.app')

@section('title') {{ __('Customers') }} @endsection

@section('content')

    <style>
        .form-inline span {
            display: none !important;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Customer\'s List') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
						<div class="card-header">
							<div class="row">								
								<div class="col-sm-12">									
									  <a href="#" style="margin:0 5px;" id="addClient" data-toggle="modal"
											class="btn btn-sm btn-primary float-sm-right">{{ __('Add Customer') }}</a>
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
												<th width="100px">{{ __('Email') }}</th>
												<th width="50px">{{ __('Action') }}</th>
											</tr>
										</thead>
										<tbody>
											@if(!count($clientUser))
												<tr class="nosort">
													<td colspan="4" class="text-center">
														{{__('No data available')}}
													</td>
												</tr>
											@else
												@foreach ($clientUser as $i=>$user)
													<tr class="odd">
														<td>{{$i+1}}</td>
														<td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>
														<td>{{$user->email}}</td>
														<td></td>
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
{{-- @include('company_user.modals.add_client') --}}
@endsection

@section('scripts')
    <script>
		$(document).on('click', '#addClient', function() {			
           $('#add_client_model').modal('toggle');
		});            
    </script>

<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
@endsection

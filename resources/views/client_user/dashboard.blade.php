@extends('client_user.layouts.app')

@section('title') {{ __('Dashboard') }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('add-model-button')
    {{-- @can('create_user') --}}
    {{-- <a href="{{ route('client_user.loans.create') }}" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-plus"></i> {{ __('Add Loan') }}
    </a> --}}
    {{-- @endcan --}}
@endsection

@section('content')

    <style>
        .form-inline span {
            display: none !important;
        }
    </style>
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->


    <div class="row">
        <div class="col-lg-12">
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
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <p class="card-text">
                        {{ __('Coming Soon!') }}
                    </p> --}}
                    <div class="row">
                        {{-- @foreach ($Testsoptions as $item)
                        <div class="col-sm-3">
                            <a href="{{route('patients.bookings')}}?status={{$item->id}}&&from_date={{$from_date}}&&to_date={{$to_date}}">
                                <div class="small-box" style="background-color: {{$item->color_code}} !important; color: {{ $item->font_color}} !important;">
                                    <div class="inner">
                                        <p>{{$item->OptionName}}</p>
                                        <h3>{{isset($counter_array[Str::slug($item->OptionName,"_")]) ? $counter_array[Str::slug($item->OptionName,"_")] : 0}}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- /.content -->
<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $('#from_date').datepicker({
        dateFormat: "mm/dd/yy",
        changeYear: true,
        changeMonth: true,
        maxDate: 0
    });
    $('#to_date').datepicker({
        dateFormat: "mm/dd/yy",
        changeYear: true,
        changeMonth: true,
    });
    $('#sh_from_date').datepicker({
        dateFormat: "mm/dd/yy",
        changeYear: true,
        changeMonth: true,
        maxDate: 0
    });
    $('#sh_to_date').datepicker({
        dateFormat: "mm/dd/yy",
        changeYear: true,
        changeMonth: true,
    });
    $("#dashboard_filter_form").submit(function (e) {
        var from_date = new Date($("#from_date").val().trim());
        var to_date = new Date($("#to_date").val().trim());
        console.log(to_date , from_date);
        if (to_date < from_date) {
            alert("To Date must greater than From Date!");
            off();
            return false;
        }
    });
    $("#sh_dashboard_filter_form").submit(function (e) {
        var from_date = new Date($("#sh_from_date").val().trim());
        var to_date = new Date($("#sh_to_date").val().trim());
        console.log(to_date , from_date);
        if (to_date < from_date) {
            alert("To Date must greater than From Date!");
            off();
            return false;
        }
    });
</script>
@endsection

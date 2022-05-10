<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">


    @include('partials.head')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixedd layout-fixed">
<div class="wrapper">
    @include('includes.submit-overlay')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="@yield('profile-route')" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="@yield('logout-route')">
                        @csrf
                        <a href="@yield('logout-route')" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link" style="padding: 4px;">
            {{-- <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span> --}}

            <img src="{{ asset('images/img.jpg') }}" alt="AdminLTE Logo">
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="@yield('profile-route')" class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            @yield('navigation')
            <hr class="py-5 my-5"/>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('partials.side_popup')

        <!-- Content Header (Page header) -->
        <div class="content-header py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>

                    </div>
                    <div class="col-sm-6">
                        @yield('add-model-button')
                    </div>
                    <div class="col-12">
                        @include('partials.validation_errors')
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
            @yield('content')
            </div>
        </div>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        {{-- <div class="float-right d-none d-sm-inline">
            Anything you want
        </div> --}}
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021-2022 <a href="{{route('login')}}">SNS LIS Admin</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!--<script src="{{ asset('js/app.js') }}"></script>-->


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif

    var datatable_processing_overlay = `
        <div style="position: fixed;display: block;width: 100%;height: 100%;top: 0;left: 0;right: 0;bottom: 0;background-color: #fff;opacity: 0.7;z-index: 9990;cursor: pointer;">
            <div style="position: absolute;top: 50%;left: 50%;font-size: 50px;color: white;transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);text-align: center;">
                <img src="{{asset('images/loading.gif')}}" alt="" style="width:25%;"/><h6 class="text-dark">Loading Please Wait ...</h6>
            </div>
        </div>
    `;



</script>
{{-- <style>
.dataTables_wrapper .dataTables_paginate .paginate_button {
padding:0px !important;
}


.dataTables_wrapper .dataTables_paginate .paginate_button:hover{

border :none !important;
background:transparent !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: black!important;
}
</style> --}}
@include('partials.scripts')

<script>

    /* swal({
        title: trans("swal_warning"),
        icon: "warning",
        type: "warning",
        buttons: trans("Close")
    }); */

    @if(Session::has('swal_warning'))
        swal({
            title: trans("{{ session('swal_warning') }}"),
            type: "warning",
            buttons: trans("Close")
        });
    @endif
</script>
{{-- @include('partials.common_script') --}}
<script>
    $(document).on('click', '.show_side_popup', function(){
        side_popup_on();
        $(`#side_popup_div`).show("fast");
        $(`#side_popup_div_content`).html('');
    });
    $(`#close_side_popup_div, #side_popup_overlay`).click(function(){
        side_popup_off();
        $(`#side_popup_div`).hide("slow");
    });
    $('#filter_btn').click(function(){
        var txt = $('#filter_txt').text();
        $('#filter_txt').text(txt == "Show" ? "Hide" : "Show");
    });
</script>
@yield('scripts')


</body>
</html>

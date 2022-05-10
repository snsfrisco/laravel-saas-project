@extends('layouts-dashboard.app')

@section('profile-route') {{ route('client_user.profile') }} @endsection

@section('logout-route') {{ route('client_user.logout') }} @endsection

@section('navigation') @include('client_user.layouts.navigation') @endsection

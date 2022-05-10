@extends('layouts-dashboard.app')

@section('profile-route') {{ route('company_user.profile') }} @endsection

@section('logout-route') {{ route('company_user.logout') }} @endsection

@section('navigation') @include('company_user.layouts.navigation') @endsection

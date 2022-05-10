@extends('layouts-dashboard.app')

@section('profile-route') {{ route('portal_user.profile') }} @endsection

@section('logout-route') {{ route('portal_user.logout') }} @endsection

@section('navigation') @include('portal_user.layouts.navigation') @endsection

@extends('layouts.app')
@section('tab-title')
    {{__('- Login')}}
@stop
@section('styles')
    <style>
        body, html {
            height: 100%;
            min-height: 100%;
            position: relative;
        }
        .content, .container-fluid {
            height: 100%;
            min-height: 100%;
        }
    </style>
@stop
@section('content')
    <div class="offset-md-2 col-md-8 lf_auth_form">
        <h2>{{__('Login Here')}}</h2>
        @include('partials.loginform')
    </div>
@stop

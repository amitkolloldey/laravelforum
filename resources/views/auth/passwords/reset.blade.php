@extends('layouts.app')
@section('tab-title')
    {{__('- Reset Password')}}
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
    <div class="offset-md-2 col-md-8 lf_auth_form lf_wrap_content">
        @include('partials.resetform')
    </div>
@stop
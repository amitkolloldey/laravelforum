<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel Forum') }}@yield('tab-title')
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('front/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('front/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('front/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('front/styles.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div class="container-fluid">

    <div class="headernav">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-xs-3 col-sm-2 col-md-2 logo ">
                    <a href="{{route('home')}}">{{ config('app.name', 'Laravel Forum') }}</a>
                </div>
                <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                    <div class="wrap">
                        <form action="#" method="post" class="form">
                            <div class="pull-left txt"><input type="text" class="form-control" placeholder="Search Topics"></div>
                            <div class="pull-right"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-5 col-md-4 avt">
                    <div class="lf_auth_links">
                        <div><a class="nav-link lf_new_topic_btn" href="{{route('topic.create')}}">{{ __('Start New
                        Topic')
                        }}</a></div>
                        @guest
                        <div><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></div>
                        <div><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></div>
                            @else
                            <div><a class="nav-link" href="#">{{ __('Hi, ') }}{{ Auth::user()->name}}</a></div>
                            @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
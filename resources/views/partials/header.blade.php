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

    <link href="{{ asset('front/rainbow.css') }}" rel="stylesheet">
    <link href="{{ asset('front/bootstrap-markdown.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('front/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('front/custom.css') }}" rel="stylesheet">
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
                <div class="col-lg-6 search hidden-xs hidden-sm col-md-3">
                    <div class="wrap">
                        {{--<form action="#" method="post" class="form">--}}
                            {{--<div class="pull-left txt"><input type="text" class="form-control" placeholder="Search Topics"></div>--}}
                            {{--<div class="pull-right"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></div>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</form>--}}
                        <div class="aa-input-container form" id="aa-input-container">
                            <input type="search" id="aa-search-input" class="form-control" placeholder="{{__('Search for Topics...')}}"
                                   name="search" autocomplete="on" />
                            <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                                <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt text-right">
                    <div class="lf_auth_links">

                            <div class="pull-left"><a class="nav-link lf_new_topic_btn" href="{{route('topic.create')}}">{{
                            __('Start
                             New
                             Topic')}}</a></div>
                            <!-- Authentication Links -->
                            @guest
                                <div class="pull-left"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></div>
                                <div class="pull-left"><a class="nav-link" href="{{ route('register') }}">{{ __
                                ('Register') }}</a></div>
                            @else
                                <div class="nav-item dropdown pull-left" id="lf_notification_wrap">
                                    <a class="nav-link dropdown-toggle" href="#" id="lf_user_link_panel"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="makeAsRead()">
                                        {{ Auth::user()->name }} @if(Auth::user()->unreadNotifications->count()>0)
                                            <span class="badge badge-light">{{Auth::user()
                                            ->unreadNotifications->count()}}@endif</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="lf_user_link_panel">
                                        @if(Auth::user()->unreadNotifications->count()>0)
                                        <div class="lf_notifications">
                                            @foreach(Auth::user()->unreadNotifications as $notification)
                                            @include('partials.notification.'.snake_case(class_basename
                                            ($notification->type)))
                                            @endforeach
                                        </div>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('user.show',Auth::user()->slug) }}">
                                            {{ __('Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>


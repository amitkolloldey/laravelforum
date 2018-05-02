@extends('layouts.app')

@section('content')
    <div class="col-md-8 lf_topics_wrapper">
        {{ $topics->links() }}
        @forelse($topics as $topic)
        <div class="post">
            <div class="wrap-ut pull-left">
                <div class="userinfo pull-left">
                    <div class="avatar">
                        <img src="images/avatar.jpg" alt="">
                        <div class="status green">&nbsp;</div>
                    </div>

                    <div class="icons">
                        <img src="images/icon1.jpg" alt=""><img src="images/icon4.jpg" alt="">
                    </div>
                </div>
                <div class="posttext pull-left">
                    <h2><a href="02_topic.html">{{__($topic->title)}}</a></h2>
                    <p>{{str_limit(__($topic->details),100)}}</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="postinfo pull-left">
                <div class="comments">
                    <div class="commentbg">
                        560
                        <div class="mark"></div>
                    </div>

                </div>
                <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                <div class="time"><i class="fa fa-clock-o"></i> {{__($topic->created_at->diffForHumans())}}</div>
            </div>
            <div class="clearfix"></div>
        </div>
            @empty
        <div class="alert alert-danger">
            {{__('No Topics Available')}}
        </div>
            @endforelse
            {{ $topics->links() }}
    </div>
    @stop
@section('sidebar')
    @include('partials.sidebar')
    @stop
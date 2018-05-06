@extends('layouts.app')
@section('tab-title')
    {{'- ' . $topic->title}}
@stop
@section('content')
    <div class="col-md-8 lf_topics_wrapper">
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        <div class="post beforepagination">
            <div class="topwrap">
                <div class="userinfo pull-left">
                    <div class="avatar">
                        <img src="{{url('uploads/avater.png')}}" alt="{{$topic->user->name}}">
                        <div class="status green">&nbsp;</div>
                        <p class="lf_points">{{ count($topicsCount) }}</p>
                    </div>
                    @if(Auth::check() && Auth::user()->id == $topic->user->id)
                    <div class="lf_icons">
                        <div class="lf_edit">
                            <a href="{{route('topic.edit',$topic->id)}}" title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                        </div>
                        <div class="lf_del">
                            <form action="{{route('topic.destroy',$topic->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="icons">
                        <img src="images/icon1.jpg" alt=""><img src="images/icon4.jpg" alt=""><img src="images/icon5.jpg" alt=""><img src="images/icon6.jpg" alt="">
                    </div>
                </div>
                <div class="posttext pull-left">
                    <h2>{{$topic->title}}</h2>
                    {!! Michelf\Markdown::defaultTransform(strip_tags($topic->details))  !!}
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="postinfobot">

                <div class="likeblock pull-left">
                    <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>25</a>
                    <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>3</a>
                </div>

                <div class="prev pull-left">
                    <a href="#"><i class="fa fa-reply"></i></a>
                </div>

                <div class="posted pull-left"><i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans()}}</div>

                <div class="next pull-right">
                    <a href="#"><i class="fa fa-share"></i></a>

                    <a href="#"><i class="fa fa-flag"></i></a>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <div class="lf_comment_wrapper">

            @forelse($comments as $comment)
            <div class="post lf_comment_list">
                <div class="topwrap">
                    <div class="posttext">
                        <div class="avatar">
                            <img src="{{url('uploads/avater.png')}}" alt="{{$topic->user->name}}">
                        <strong class="lf_commenter_name">{{$topic->user->name .' '}} <span>{{ __('said')}}</span></strong>
                        </div>
                        {!! Michelf\Markdown::defaultTransform(strip_tags($comment->body))  !!}
                    </div>
                </div>
                <div class="postinfobot">


                    <div class="userinfo">

                        @if(Auth::check() && Auth::user()->id == $comment->user_id)
                            <div class="lf_icons pull-right">
                                <div class="lf_edit pull-right">
                                    <a href="{{route('topic.edit',$comment->id)}}" title="{{__('Edit')}}">

                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="lf_del pull-right">
                                    <form action="{{route('topic.destroy',$comment->id)}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                        <div class="posted pull-left"><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans()
                    }}</div>
                    </div>
                </div>
            </div>
            @empty
                <div class="post">

                    <div class="alert alert-info">
                        {{__('Become first one to comment on this topic?')}}
                    </div>

                </div>
            @endforelse
            <div class="post">

                @if (count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form action="{{route('topic.comment.create',$topic->id)}}" class="form" method="post">
                    {{csrf_field()}}
                    {{method_field('POST')}}
                    <div class="postinfobot">
                        <textarea class="form-control" id="body" rows="5" name="body" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{old('body')}}</textarea>

                        <div class="pull-right postreply">
                            <div class="pull-left"><button type="submit" class="btn btn-primary">{{__('Post Comment')}}</button></div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('sidebar')
    @include('partials.sidebar')
@stop
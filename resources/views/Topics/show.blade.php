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
                    <h2 class="lf_topic_title">{{$topic->title}}</h2>
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
        <div class="lf_comment_wrapper" id="lf_comments_wrap">
            @if (Session::has('commentmessage'))
                <div class="alert alert-success">{{ Session::get('commentmessage') }}</div>
            @endif
            @forelse($comments as $comment)
            <div class="post lf_comment_list" id="commentno{{$comment->id}}">
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
                                    <a href="#" title="{{__('Edit')}}" data-toggle="modal"
                                       data-target="#lf_comment_edit_modal{{$comment->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- Modal -->
                                    <div id="lf_comment_edit_modal{{$comment->id}}" class="lf_modal modal fade @if($errors->has('editcommentbody')) show @endif " role="dialog">

                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">

                                                <div class="modal-body ">
                                                    <form action="{{route('comment.update',$comment->id)}}" method="post">
                                                        @if (Session::has('editcommentbody'.$comment->id))
                                                            <div class="alert alert-danger">{{ Session::get('editcommentbody'.$comment->id) }}</div>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#lf_comment_edit_modal{{$comment->id}}').modal('show');
                                                                });
                                                            </script>
                                                        @endif
                                                        {{csrf_field()}}
                                                        {{method_field('PATCH')}}
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="editcommentbody"
                                                                      rows="10" name="editcommentbody" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{$comment->getOriginal()['body']}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary" value="{{__('Update Comment')}}">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lf_del pull-right">
                                    <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                        <div class="posted pull-left">
                            <i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans()}}
                            <a href="#" title="{{__('Reply')}}" class="lf_reply"><i class="fa fa-reply"></i></a>
                        </div>
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
           {{$comments->fragment('lf_comments_wrap')->links()}}
            @if(Auth::check())
            <div class="post" id="lf_comment_create_form">
                @if (Session::has('commentcreateerror'))
                    <div class="alert alert-danger">{{ Session::get('commentcreateerror') }}</div>
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
            @else
            <div class="post">
                <div class="alert alert-success">
                    <a href="{{route('login')}}">{{__('Please Login To Leave A Comment')}}</a>
                </div>
            </div>
            @endif
        </div>
    </div>

@stop
@section('sidebar')
    @include('partials.sidebar')
@stop



@extends('layouts.app')
@section('tab-title')
    {{__('- '.$user->name)}}
@stop
@section('content')
    <div class="col-md-12 ">
        <div class="lf_wrap_content">
             <div class="row">
                 <div class="col-md-4">
                     <div class="lf_user_image">
                         <img src="{{ Gravatar::fallback(url('uploads/avater.png'))->get( $user->email,['size'=>300])}}" alt="{{$user->name}}" class="card-img">
                     </div>
                 </div>
                 <div class="col-md-8">

                     <div class="lf_user_info">
                         <div class="lf_user_profile_feed">
                             <h2>{{$user->name . __('\'s Activity Feed')}}</h2>
                         </div>
                         <div class="lf_user_topics" id="lf_user_topics">
                             <h3>{{__('Topics Created')}}</h3>
                             <ul>
                                @forelse($topics as $topic)
                                    <li><a href="{{route('topic.show',$topic->id)}}">{{$topic->title}}</a></li>
                                    @empty
                                     <li>{{__('No Topic Created By ').$user->name}}</li>
                                    @endforelse
                                    {{ $topics->fragment('lf_user_topics')->links() }}
                             </ul>
                         </div>
                         <div class="lf_user_topics" id="lf_user_comments">
                             <h3>{{__('Commented')}}</h3>
                             <ul>
                                @forelse($commented_topics as $commented_topic)
                                    <li>
                                        <a href="{{route('topic.show',$commented_topic->id)}}">
                                            {!! $commented_topic->title !!}
                                        </a>
                                        <p>{!! Michelf\Markdown::defaultTransform(strip_tags($commented_topic->body))  !!}</p>
                                    </li>
                                    @empty
                                     <li>{{__('No Comment By ').$user->name}}</li>
                                    @endforelse
                                    {{ $commented_topics->fragment('lf_user_comments')->links() }}
                             </ul>
                         </div>
                     </div>
                         <div class="lf_user_topics" id="lf_user_likes">
                             <h3>{{__('Liked')}}</h3>
                             <ul>
                                @forelse($liked_topics as $liked_topic)
                                    <li>
                                        <a href="{{route('topic.show',$liked_topic->id)}}">
                                            {{ $liked_topic->title }}
                                        </a>
                                    </li>
                                    @empty
                                     <li>{{__('No Comment By ').$user->name}}</li>
                                    @endforelse
                                    {{ $liked_topics->fragment('lf_user_likes')->links() }}
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
    </div>
@stop


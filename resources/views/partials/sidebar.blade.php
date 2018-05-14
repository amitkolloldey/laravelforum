<div class="col-lg-4 col-md-4 lf_sidebar_wrapper">

    <!-- -->
    <div class="sidebarblock">
        <h3>{{__('Top Tags')}}</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <ul class="cats">
                @forelse($tags as $tag)
                <li><a href="{{route('tag.topics',$tag->tag_id)}}">{{$tag->name}} <span class="badge
                pull-right">{{$tag->topics->count()
                }}</span></a></li>
                @empty
                <li>{{__('No Tags Found!')}}</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="sidebarblock" id="lf_most_popular_topics">
        <h3>{{__('Most Popular')}}</h3>
        @forelse($topicview as $topicmostviewed)
        <div class="blocktxt">
            <a href="{{route('topic.show',$topicmostviewed->id)}}">{{$topicmostviewed->title}}</a>
        </div>
        <div class="divline"></div>
        @empty
        <div class="blocktxt">
            <p>{{__('No Topics')}}</p>
        </div>
        <div class="divline"></div>
        @endforelse
    </div>
@if($usertopics->count()>0)
    <div class="sidebarblock" id="lf_user_active_topics">
        <h3>{{__('My Active Threads')}}</h3>
        @forelse($usertopics as $usertopic)
        <div class="blocktxt">
            <a href="{{route('topic.show',$usertopic->id)}}">{{$usertopic->title}}</a>
        </div>
        <div class="divline"></div>
        @empty
        <div class="blocktxt">
            <p>{{__('You have no active topics')}}</p>
        </div>
        <div class="divline"></div>
        @endforelse
    </div>
@endif
</div>
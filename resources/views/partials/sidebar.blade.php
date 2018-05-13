<div class="col-lg-4 col-md-4 lf_sidebar_wrapper">

    <!-- -->
    <div class="sidebarblock">
        <h3>Categories</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <ul class="cats">
                <li><a href="#">Trading for Money <span class="badge pull-right">20</span></a></li>
                <li><a href="#">Vault Keys Giveway <span class="badge pull-right">10</span></a></li>
                <li><a href="#">Misc Guns Locations <span class="badge pull-right">50</span></a></li>
                <li><a href="#">Looking for Players <span class="badge pull-right">36</span></a></li>
                <li><a href="#">Stupid Bugs &amp; Solves <span class="badge pull-right">41</span></a></li>
                <li><a href="#">Video &amp; Audio Drivers <span class="badge pull-right">11</span></a></li>
                <li><a href="#">2K Official Forums <span class="badge pull-right">5</span></a></li>
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
        {{$topicview->fragment('lf_most_popular_topics')->links()}}
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
        {{$usertopics->fragment('lf_user_active_topics')->links()}}
    </div>
@endif
</div>
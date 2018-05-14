<a class="dropdown-item" href="{{route('topic.show',$notification->data['topic']['id']).'#commentno'
.$notification->data['comment']['id']}}" >
    {{'"'.$notification->data['user']['name'].__('" Has Commented On "').$notification->data['topic']['title']}}
"</a><span>{{Carbon\Carbon::parse($notification->data['created_at']['date'])->diffForHumans()}}</span>

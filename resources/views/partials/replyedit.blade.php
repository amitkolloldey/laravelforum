<a href="#" title="{{__('Edit')}}" data-toggle="modal" data-target="#lf_reply_edit_modal{{$reply->id}}">
    <i class="fa fa-edit"></i>
</a>
<!-- Modal -->
<div id="lf_reply_edit_modal{{$reply->id}}" class="lf_modal modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body ">
                <form action="{{route('reply.update',$reply->id)}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    @if (Session::has('editreplybody'.$reply->id))
                        <div class="alert alert-danger">{{ Session::get('editreplybody'.$reply->id) }}</div>
                        <script>
                            $(document).ready(function() {
                                $('#lf_reply_edit_modal{{$reply->id}}').modal('show');
                            });
                        </script>
                    @endif

                    <div class="form-group">
                        <textarea class="form-control" id="editreplybody" rows="10" name="editreplybody" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{$reply->getOriginal()['body']}}</textarea>
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="topic_slug" value="{{$topic->slug}}">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="{{__('Update Reply')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
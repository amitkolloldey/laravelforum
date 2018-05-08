<a href="#" title="{{__('Edit')}}" data-toggle="modal" data-target="#lf_comment_edit_modal{{$comment->id}}">
    <i class="fa fa-edit"></i>
</a>
<!-- Modal -->
<div id="lf_comment_edit_modal{{$comment->id}}" class="lf_modal modal fade" role="dialog">

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
                       <textarea class="form-control" id="editcommentbody" rows="10" name="editcommentbody" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{$comment->getOriginal()['body']}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="{{__('Update Comment')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
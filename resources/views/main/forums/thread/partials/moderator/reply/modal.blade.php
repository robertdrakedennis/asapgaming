<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#moderatorReplyOptions-{{$reply->id}}">
    Moderator Options
</button>
<div class="modal fade" id="moderatorReplyOptions-{{$reply->id}}" style="word-break: break-word;" tabindex="-1" role="dialog" aria-labelledby="moderatorReplyOptionstitle-{{$reply->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="moderatorReplyOptionstitle-{{$reply->id}}">Options for reply #{{$reply->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row justify-content-center">
                    @if($reply->trashed())
                            <form method="POST" class="mx-1" action="{{ action('ReplyController@Restore', [$category, $thread, $reply->id])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-warning">Restore</button>
                            </form>
                    @else
                            <form method="POST" class="mx-1" action="{{ action('ReplyController@Destroy', [$category, $thread, $reply])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    @endif
                        <a href="{{ route('replies.edit', [$category, $thread, $reply->id])}}" class="btn btn-dark">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>

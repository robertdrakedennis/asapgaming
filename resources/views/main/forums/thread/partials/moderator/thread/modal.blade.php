<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#moderatorThreadOptions">
    Moderator Options
</button>
<div class="modal fade" id="moderatorThreadOptions" tabindex="-1" role="dialog" aria-labelledby="moderatorThreadOptionsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="moderatorThreadOptionsTitle" style="word-break: break-word;">Options for {{$thread->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        @if($thread->isPinned)
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@pinThread', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success">Un-pin Thread</button>
                            </form>
                        @else
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@pinThread', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success">Pin Thread</button>
                            </form>
                        @endif

                        @if($thread->isLocked)
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@lockThread', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success">Unlock Thread</button>
                            </form>
                        @else
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@lockThread', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Lock Thread</button>
                            </form>
                        @endif
                        @if($thread->trashed())
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@Restore', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-warning">Restore Thread</button>
                            </form>
                        @else
                            <form method="POST" class="mx-1" action="{{ action('ThreadController@Destroy', [$category, $thread])}}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Delete Thread</button>
                            </form>
                        @endif
                        <a href="{{ route('threads.edit', [$category, $thread])}}" class="btn btn-dark">Edit</a>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <form method="POST" action="{{ action('ThreadController@movethread', [$category, $thread]) }}">
                            @method('POST')
                            @csrf
                            <div class="form-group my-5 text-black">
                                <select id="category" class="form-control"  name="category_id">
                                    @foreach($allCategories as $allCategory)
                                        <option value="{{$allCategory->id}}" @if($allCategory->id == $category->id) selected @endif> {{$allCategory->title}}</option>
                                    @endforeach
                                </select>
                                <label for="category" class="text-black">Move Category</label>
                            </div>
                            <button type="submit" class="btn btn-warning">Move Thread</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

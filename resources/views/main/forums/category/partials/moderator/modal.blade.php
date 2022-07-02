<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#moderatorOptions">
    Moderator Options
</button>
<div class="modal fade" id="moderatorOptions" tabindex="-1" role="dialog" aria-labelledby="moderatorOptionstitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content w-75">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="moderatorOptionstitle">Options for {{$category->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        @if($category->isPrivate)
                            <form method="POST" class="mx-1 text-center my-2" action="{{ action('CategoryController@privateCategory', $category) }}">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-warning">Un-private Category</button>
                            </form>
                        @else
                            <form method="POST" class="mx-1 text-center my-2" action="{{ action('CategoryController@privateCategory', $category) }}">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-danger">Private Category</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @if($category->isLocked)
                            <form method="POST" class="mx-1 text-center my-2" action="{{ action('CategoryController@lockCategory', $category) }}">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-warning">Unlock Category</button>
                            </form>
                        @else
                            <form method="POST" class="mx-1 text-center my-2" action="{{ action('CategoryController@lockCategory', $category) }}">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-danger">lock Category</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="text-center my-2">
                            <a href="{{route('categories.edit', $category)}}" class="btn btn-dark mx-1">Edit Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

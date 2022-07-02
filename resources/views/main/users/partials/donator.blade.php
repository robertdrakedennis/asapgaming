<button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#donatorOptions-{{ $user->id }}">
    Donator Options
</button>
<div class="modal fade" id="donatorOptions-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="donatorOptionsTitle-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="donatorOptionsTitle-{{ $user->id }}">Donator Options for {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 py-4">
                            <div class="alert alert-warning m-3">
                                Seriously, do not abuse these features. You will have your status permanently revoked immediately if you do so.
                            </div>
                            <form method="POST" class="text-left" action="{{ action('UserController@Update', $user) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label for="titleInput">Custom url: your current custom url is: <code>{{ env('APP_URL') }}/users/{{$user->slug}}</code></label>
                                    <input type="text" name="slug" class="form-control" id="titleInput" aria-describedby="titleHelp">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="custom-file-input" name="background" id="background">
                                    <label class="custom-file-label" for="background">Upload Background</label>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="custom-file-input" name="post_background" id="post_background">
                                    <label class="custom-file-label" for="post_background">Upload Post Background</label>
                                </div>

                                <div class="form-group">
                                    <label for="color">Select a Color</label>
                                    <input type='text' id="color" name="color" />
                                </div>

                                <button type="submit" class="btn btn-primary my-2">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

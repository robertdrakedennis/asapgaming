<button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#generalOptions-{{ $user->id }}">
    General Options
</button>
<div class="modal fade" id="generalOptions-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="generalOptionsTitle-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="generalOptionsTitle-{{ $user->id }}">Options for {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 py-4">
                        <form method="POST" class="text-left" action="{{ action('UserController@Update', $user) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <div class="input-field">
                                    <label for="titleInput" class="text-white">Name</label>
                                    <input type="text" class="form-control" name="name" class="text-light" id="titleInput" aria-describedby="titleHelp" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <quill-component @if($user->about !== null) :post="{{ $user->about }}" @endif></quill-component>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                    <label class="custom-file-label" for="avatar">Upload Avatar</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <form method="POST" action="{{ action('UserController@syncWithSteam', $user) }}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark float-right">
                                    <i class="fab fa-steam-symbol fa-fw"></i> Sync with steam
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

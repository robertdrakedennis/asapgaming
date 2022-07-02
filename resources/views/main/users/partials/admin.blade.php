<button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#adminOptions-{{ $user->id }}">
    Admin Options
</button>
<div class="modal fade" id="adminOptions-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="adminOptionsTitle-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="adminOptionsTitle-{{ $user->id }}">Admin Options for {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 py-4">
                            <form method="POST" class="" action="{{ action('UserController@setRank', $user) }}">
                                @method('POST')
                                @csrf
                                <div class="form-group my-2">
                                    <label for="role">Choose Role</label>
                                    <select class="form-control" id="role" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}" @if($role->name == $user->roles()->first()->name) selected @endif> {{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="waves-effect waves-light btn btn-primary m-2 float-right">Set Rank</button>
                            </form>

                            <form method="POST" class="my-5" action="{{ action('UserController@setCredits', $user) }}">
                                @method('POST')
                                @csrf
                                <div class="form-group my-2">
                                    <input id="credits" class="form-control" name="credits" type="number" value="{{ $user->credits }}">
                                    <label for="credits">Set Credits</label>
                                </div>
                                <button type="submit" class="waves-effect waves-light btn btn-primary m-2 float-right">Set Credits</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

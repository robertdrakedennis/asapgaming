<button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#steamOptions-{{ $user->id }}">
    Steam Info
</button>
<div class="modal fade" id="steamOptions-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="steamOptionsTitle-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="steamOptionsTitle-{{ $user->id }}">Steam Info for {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 py-4 text-left">
                        <div class="form-group">
                            <div class="input-field">
                                <label for="steamId">SteamId 64:</label>
                                <input readonly type="text" class="form-control" id="steamId" value="{{ $steam->steamId }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-field">
                                <label for="steamId2">SteamId 2:</label>
                                <input readonly type="text" class="form-control" id="steamId2" value="{{ $steam->steamId2 }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-field">
                                <label for="steamId3">SteamId 3:</label>
                                <input readonly type="text" class="form-control" id="steamId3" value="{{ $steam->steamId3 }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
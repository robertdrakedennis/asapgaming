
<div class="modal fade" id="StoreModalOptions" style="word-break: break-word;" tabindex="-1" role="dialog" aria-labelledby="StoreModalOptionsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-dark" id="StoreModalOptionsTitle">Purchase Credits</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card bg-transparent border-0">
                    <div class="card-body text-dark">
                        <form action="{{ route('purchase.index') }}" method="post">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label class="text-muted" for="steamid"><i class="fab fa-steam-symbol"></i> Steamid (steamid, steamid3, steamid64)</label>
                                <input type="text" class="form-control" id="steamid" name="steamid" @auth value="{{ "[U:1:" . Auth::user()->steam_account_id ."]" }}" @endauth required />
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="EUR"><i class="fas fa-euro-sign"></i> What you pay</label>
                                <input type="number" class="form-control" name="euroAmount" id="EUR" title="EUR" value="6" required>
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="creditAmount"><i class="fas fa-coins"></i> Credits you'll get</label>
                                <input type="number" class="form-control" id="creditAmount" name="creditAmount" title="creditAmount" value="600" required>
                            </div>
                            <button type="submit" id="submitOrder" class="btn btn-block btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>

        $("#EUR").on("input", function(e) {
            $("#creditAmount").val(($(this).val() * 100));
            checkValue();
        });

        $("#creditAmount").on("input", function(e) {
            $("#EUR").val(($(this).val() / 100));
            checkValue();
        });

        function checkValue() {
            if ($('#EUR').val() < 6) {
                $("#submitOrder").attr("disabled", true);
            } else {
                $("#submitOrder").removeAttr("disabled");
            }
        }
    </script>
@endsection

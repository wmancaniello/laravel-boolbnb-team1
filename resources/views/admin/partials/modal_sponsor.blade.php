<div class="modal fade mt-5" id="sponsorModal{{ $flat->slug }}" tabindex="-1" aria-labelledby="sponsorModalLabel"
    aria-hidden="true">
    {{-- @dd($flat); --}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sponsorModalLabel">Scegli il tuo piano di sponsorizzazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="payment-form" action="{{ route('admin.checkout')}}" method="POST">
                    @csrf
                    @foreach ($sponsors as $sponsor)
                        @php
                            $durationEx = explode(':', $sponsor->duration);
                            $amountH = $durationEx[0];
                        @endphp
                        <div>
                            <input type="radio" name="sponsor_id" value="{{ $sponsor->id }}" id="{{ $sponsor->id }}">
                            <label for="{{ $sponsor->id }}"> <b>{{ $sponsor->price }}€</b> per {{ $amountH }}h di Sponsorizzazione</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="amount" id="amount" value="">
                    <input type="hidden" name="flat_id" value="{{ $flat->id }}">
                    <div id="dropin-container"></div>
                    <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn ms_btn-sponsor">Sponsorizza</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


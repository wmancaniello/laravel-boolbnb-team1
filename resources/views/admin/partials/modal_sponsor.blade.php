<div class="modal fade mt-5" id="sponsorModal{{ $flat->slug }}" tabindex="-1" aria-labelledby="sponsorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sponsorModalLabel">Conferma Sponsor</h5>
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
                            <input type="radio" name="sponsor" value="{{ $sponsor->id }}" id="{{ $sponsor->id }}">
                            <label for="{{ $sponsor->id }}"> <b>{{ $sponsor->price }}€</b> per {{ $amountH }}h di Sponsorizzazione!</label>
                        </div>
                    @endforeach
                    <input type="hidden" name="amount" id="amount" value="">
                    <div id="dropin-container"></div>
                    <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-light">Sponsorizza</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('payment-form');
    
        // Recupera il token del client dal server
        fetch('{{ route('admin.client_token') }}')
            .then(response => response.json())
            .then(data => {
                var clientToken = data.clientToken;
                console.log(clientToken);   
    
                braintree.dropin.create({
                    authorization: clientToken,
                    container: '#dropin-container'
                }, function (createErr, instance) {
                    if (createErr) {
                        console.error(createErr);
                        return;
                    }
    
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
    
                        instance.requestPaymentMethod(function (err, payload) {
                            if (err) {
                                console.error(err);
                                return;
                            }
    
                            // Inserisci il nonce nel modulo e invia
                            document.getElementById('payment_method_nonce').value = payload.nonce;
                            form.submit();
                        });
                    });
                });
            })
            .catch(() => {
                console.error('Errore nella transazione');
            });
    });
</script>

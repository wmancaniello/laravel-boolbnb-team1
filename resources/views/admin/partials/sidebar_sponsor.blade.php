<div class="ms_sidebar ms_hidden d-flex align-items-center justify-content-center" id="pay-sidebar">
    <div class="container p-5">
        <form id="payment-form" action="{{ route('admin.checkout') }}" method="POST"
            class="d-flex flex-column gap-2 w-100">
            @csrf
            <div class="w-100 d-flex align-items-center justify-content-center gap-3">
                @foreach ($sponsors as $sponsor)
                    @php
                        $durationEx = explode(':', $sponsor->duration);
                        $amountH = $durationEx[0];
                    @endphp
                    
                    <input type="radio" class="d-none" name="sponsor_id" value="{{ $sponsor->id }}"
                        id="{{ $sponsor->id }}">
                    <label class="ms_sponsor-card rounded-2" for="{{ $sponsor->id }}">
                        <div class="text-center">
                            <h4>{{ $sponsor->price }} €</h4>
                            <p>Durata sponsor : </p>
                            <h5>{{ $amountH }} H</h5>
                        </div>
                    </label> 
                @endforeach
            </div>
            <input type="hidden" name="amount" id="amount" value="">
            <input type="hidden" name="flat_id" value="{{ $flat->id }}">
            <div id="dropin-container"></div>
            <input type="hidden" name="payment_method_nonce" id="payment_method_nonce">
            <div class="d-flex align-items-center justify-content-center gap-3 d-none" id="pay-btns">
                <button type="button" class="btn btn-danger" onclick="showSidebar()">Annulla</button>
                <button type="submit" class="btn ms_btn-sponsor">Sponsorizza</button>
            </div>
        </form>
    </div>
</div>


<style lang="scss">
   
    .ms_hidden {
        opacity: 0;
        overflow: hidden;
        width: 0px;
        z-index: -1;
    }

    .ms_sidebar {
        position: absolute;
        top: 0;
        right: 0;
        background-color: var(--bg-color);
        height: 100vh;
        transition: opacity 0.7s;
    }

    .ms_active {
        width: 100%;
        z-index: 9999;
    }

    .ms_sponsor-card {
        aspect-ratio: 4/6;
        padding: 20px;
        background-color: white;
        box-shadow: 2px 2px 0px var(--primary-color), 8px 8px 10px 0px rgba(34, 33, 33, 0.418);
        border: 0;
        cursor: pointer;
        transition: 0.7s;

        &:hover {
            box-shadow: 2px 2px 0px var(--primary-color);
            transition: 0.7s;
        }
    }

    input[type="radio"]:checked+label {
        box-shadow: 4px 4px 0px white;
        background-color: var(--primary-color);
        color: white;
        transition: 0.7s;
    }

    

    
</style>

<script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.js"></script>
<script>
    const sideBarElem = document.getElementById('pay-sidebar');
    /* console.log(sideBarElem); */
    const sponsorBtn = document.getElementById('sponsor-btn');

    const payBtns = document.getElementById('pay-btns');

    function showSidebar() {
        sideBarElem.classList.toggle('ms_hidden');
        sideBarElem.classList.toggle('ms_active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('payment-form');

        const radios = document.querySelectorAll('input[name="sponsor_id"]');
        radios.forEach(radio => {
            radio.addEventListener('change', (event) => {
                if (event.target.checked) {

                    /* console.log(`Selezionato: ${event.target.value}`); */


                    // Recupera il token del client dal server
                    fetch('{{ route('admin.client_token') }}')
                        .then(response => response.json())
                        .then(data => {
                            var clientToken = data.clientToken;
                            /* console.log(clientToken); */

                            braintree.dropin.create({
                                authorization: clientToken,
                                container: '#dropin-container',
                                locale: 'it'
                            }, function(createErr, instance) {
                                if (createErr) {
                                    console.error(createErr);
                                    return;
                                }
                                payBtns.classList.remove('d-none');
                                form.addEventListener('submit', function(event) {
                                    event.preventDefault();

                                    instance.requestPaymentMethod(function(
                                        err, payload) {
                                        if (err) {
                                            console.error(err);
                                            return;
                                        }

                                        // Inserisci il nonce nel modulo e invia
                                        document.getElementById(
                                                'payment_method_nonce'
                                            ).value =
                                            payload.nonce;
                                        form.submit();
                                    });
                                });
                            });
                        })
                        .catch(() => {
                            console.error('Errore nella transazione');
                        });
                }
            });
        });

    });
</script>

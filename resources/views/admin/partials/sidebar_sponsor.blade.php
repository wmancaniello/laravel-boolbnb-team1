<div class="ms_sidebar ms_hidden d-flex align-items-center justify-content-center" id="pay-sidebar">
    <div class="container-fluid">
        <form id="payment-form" action="{{ route('admin.checkout') }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($sponsors as $sponsor)
                            @php
                                $durationEx = explode(':', $sponsor->duration);
                                $amountH = $durationEx[0];
                                $plans = ['Basic', 'Premium', 'Elite']
                            @endphp
                            {{-- Colonna --}}
                            <input type="radio" class="d-none" name="sponsor_id" value="{{ $sponsor->id }}"
                                id="{{ $sponsor->id }}">
                            <div class="col-sm-12 col-md-4 d-flex g-2 gap-2 ms_transition-7">
                                <label for="{{ $sponsor->id }}" class="ms_transition-7">
                                    {{-- Card --}}
                                    <div class="price-table h-100">
                                        {{-- Header --}}
                                        <div class="price-head" id="head-tab-pr">
                                            <p class="fs-3">{{ $plans[ $loop->index ]}}</p>
                                            <h2>€{{ $sponsor->price }}/{{ $amountH }}h</h2>
                                        </div>
                                        {{-- Corpo --}}
                                        <div class="price-content">
                                            <ul>
                                                <li>Presenza premium in HomePage!</li>
                                                <li>Spunta per primo in tutte le ricerche!</li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- Fine Card --}}
                                </label>
                            </div>
                            {{-- Fine Colonna --}}
                        @endforeach
                    </div>
                </div>
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
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');    
/* Old Card */
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

    .ms_transition-7{
        transition: all 0.7s;
    }

    input[type="radio"]:checked+div label {
        /* box-shadow: 4px 4px 0px white; */
        color: white;
        transform: translateY(-40px);
        transition: all 0.7s;
    }

    /* Old Card */

    /* New Card */
    .price-table {
        text-align: center;
        overflow: hidden;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        color: white;
        margin: 10px;
        background: #fff;
        cursor: pointer;
        box-sizing: border-box;
        box-shadow: inset 0 0 40px rgba(0, 0, 0, .2), 0 20px 50px rgba(0, 0, 0, .5);
        border-radius: 20px;
        transition: all 0.7s;
    }

    .price-table:hover{
        transform: translateY(-20px);
        transition: all 0.7s;
        box-shadow: none;
    }

    #head-tab-pr {
        padding: 50px;
        background: linear-gradient(45deg, rgba(51,49,45,1) 2%, rgba(112,93,63,1) 60%, rgba(248,242,235,1) 100%);
        transition: all 0.7s;
    }

    .price-table:hover #head-tab-pr{
        border-bottom-left-radius: 50%;
        border-bottom-right-radius: 50%;
        transition: 0.7s;
    }

    .price-table .price-head h4 {
        text-transform: uppercase;
        margin: 0;
        padding: 0;
        color: #fff;
        font-weight: 700;
    }

    .price-table .price-head h2 {
        margin: 0;
        padding: 20px 40px 0;
        font-size: 1.5rem;
        color: #fff;
    }

    .price-content {
        position: relative;
    }

    .price-content ul {
        position: relative;
        margin: 0;
        padding: 20px 0;
    }
    .price-content ul li {
        list-style: none;
        font-size: 1rem;
        padding: 10px 20px;
        color: #777;
        cursor: pointer;
        transition: .7s;
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

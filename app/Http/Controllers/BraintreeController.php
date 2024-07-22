<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Gateway;
# ---------------------------------------
class BraintreeController extends Controller
{
   protected $gateway;

    // Costruttore inizializza il gateway
    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'zyhjkqfp8xpzwjrf',
            'publicKey' => 'xdyjf5zpgfy5fv43',
            'privateKey' => 'd8e56aef3bd531b1f71d63be20482f34'
        ]);
    }

    // Genera il token
    public function generateToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    // Checkout
    public function checkout(Request $request)
    {
        $nonceFromTheClient = $request->payment_method_nonce;
        $sponsorRadio = $request->sponsor; // Importo della transazione
        $newSponsor = Sponsor::where('id', $sponsorRadio)->get();
        $amount = $newSponsor[0]->price;
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->route('admin.flats.index')->with('success', 'Appartamento sponsorizzato con successo'); 
            /* response()->json(['message' => 'Transazione completata con successo.', 'transactionId' => $result->transaction->id]); */
        } else {
            return response()->json(['message' => 'Transazione fallita.', 'error' => $result->message], 500);
        }
    }
}

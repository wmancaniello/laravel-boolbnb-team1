<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;

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
        // Variabili per gli Id della tabella ponte
        $flatId = $request->flat_id;
        $sponsorId = $request->sponsor_id;

        // Variabili per il pagamento
        $nonceFromTheClient = $request->payment_method_nonce;
        // Sponsor selezionato dal radio di pagamento
        $sponsorRadio = $request->sponsor_id;

        // Istanzio lo sponsor, in base a quello selezionato dall'utente
        $newSponsor = Sponsor::where('id', $sponsorRadio)->get();
        $amount = $newSponsor[0]->price;

        // Pagamento
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // Se il pagamento va a buon fine
        if ($result->success) {
            // Prendo l'appartamento collegato all'id
            $flat = Flat::find($flatId);
            // Controllo l'esistenza Appartamento
            if ($flat) {
                if (!empty($newSponsor) && isset($newSponsor[0])) {
                    // Durata sponsor
                    $duration = $newSponsor[0]->duration;
                    // Ottengo la durata in formato H dello sponsor 
                    $durationParts = explode(':', $duration);
                    // Converto in int la prima posizione ossia -> [H] : i : s
                    $hoursToAdd = intval($durationParts[0]);
                        // Prendo lo sponsorPivot, dalla tabella ponte
                        $flatPivot = $flat->sponsors()->wherePivot('flat_id', $flatId)->first();
                        // Se esiste collegamento ponte tra sponsor_id e flat_id
                        if ($flatPivot) {
                            // Salvo in questa variabile la fine sponsor
                            $endDate = $flatPivot->pivot->end_date;
                            $sponsorIdPivot = $flatPivot->pivot->sponsor_id;

                            
                            // Creare un oggetto Carbon con il fuso orario corretto
                            $parsedEnd = Carbon::parse($endDate, 'Europe/Rome');

                            // Ottenere l'ora attuale in 'Europe/Rome'
                            $now = Carbon::now('Europe/Rome');

                            // CASO : SCADUTO SPONSOR
                            if ($parsedEnd->lt($now)) {
                                // Rimuovi la relazione dalla tabella pivot
                                $flat->sponsors()->detach($sponsorIdPivot);
                                $startDate = Carbon::now('Europe/Rome');
                                $endDate = Carbon::now()->addHours($hoursToAdd);

                                $flat->sponsors()->attach($sponsorIdPivot, [
                                    'start_date' => $startDate,
                                    'end_date' => $endDate
                                ]);
                            } else {
                                // CASO : ANCORA VALIDO
                                // Salvo la end_date del pivot -> Già salvata in $endDate -> Convertita in $parsedEnd
                                /* $flat->sponsors()->detach($sponsorId); */
                                $startDate = Carbon::now('Europe/Rome');
                                $fixedEnd = $parsedEnd->addHours($hoursToAdd);
                                $flat->sponsors()->detach($sponsorIdPivot);
                                $flat->sponsors()->attach($sponsorIdPivot, [
                                    'start_date' => $startDate,
                                    'end_date' => $fixedEnd
                                ]);
                            }
                        } else {
                            // CASO : PRIMO SPONSOR
                            $startDate = Carbon::now('Europe/Rome');
                            $endDate = Carbon::now()->addHours($hoursToAdd);
                            $flat->sponsors()->attach($sponsorId, [
                                'start_date' => $startDate,
                                'end_date' => $endDate
                            ]);
                        }
                    }
                }
            return redirect()->route('admin.flats.index')->with('success', 'Appartamento sponsorizzato con successo');
        } else {
            return response()->json(['message' => 'Transazione fallita.', 'error' => $result->message], 500);
        }
    }
}

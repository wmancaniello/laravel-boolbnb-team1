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
        $nonceFromTheClient = $request->payment_method_nonce;
        $sponsorRadio = $request->sponsor_id;
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
            $flat = Flat::find($request->flat_id);
            // Controllo esistenza Appartamento
            if ($flat) {
                if (!empty($newSponsor) && isset($newSponsor[0])) {
                    // Durata sponsor
                    $duration = $newSponsor[0]->duration;
                    $durationParts = explode(':', $duration);
                    $hoursToAdd = intval($durationParts[0]);
                    // Controllo aggiunta / modifica
                    if ($flat->sponsors) {
                        $sponsorPivot = $flat->sponsors()->wherePivot('sponsor_id', $sponsorId)->first();
                        // Controllo se è scaduto
                        /* if ($flat->sponsors->end_date < Carbon::now()) {
                            $flat->sponsors()->detach($sponsorId);
                            $startDate = Carbon::now('Europe/Rome');
                            $endDate = Carbon::now()->addHours($hoursToAdd);

                            $flat->sponsors()->attach($sponsorId, [
                                'start_date' => $startDate,
                                'end_date' => $endDate
                            ]);
                        } else {
                            $start_date_ex = $flat->sponsors->start_date;
                            $flat->sponsors()->end_date = Carbon::parse($start_date_ex)->addHours($hoursToAdd);
                        } */
                        if ($sponsorPivot) {
                            $endDate = $sponsorPivot->pivot->end_date;
                            // Debugging: visualizza la data di fine
                            /* dd($endDate); */
                            // Creazione di $parsedEnd in UTC
                            // Creare un oggetto Carbon con il fuso orario corretto
                            $parsedEnd = Carbon::parse($endDate, 'Europe/Rome');

                            // Ottenere l'ora attuale in 'Europe/Rome'
                            $now = Carbon::now('Europe/Rome');

                            // CASO : SCADUTO SPONSOR
                            if ($parsedEnd->lt($now)) {
                                // Rimuovi la relazione dalla tabella pivot
                                $flat->sponsors()->detach($sponsorId);
                                $startDate = Carbon::now('Europe/Rome');
                                $endDate = Carbon::now()->addHours($hoursToAdd);

                                $flat->sponsors()->attach($sponsorId, [
                                    'start_date' => $startDate,
                                    'end_date' => $endDate
                                ]);
                            } else {
                                // CASO : ANCORA VALIDO
                                $flat->sponsors()->detach($sponsorId);
                                $startDate = Carbon::now('Europe/Rome');
                                $fixedEnd = $parsedEnd->addHours($hoursToAdd);
                                $flat->sponsors()->attach($sponsorId, [
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
            }
            return redirect()->route('admin.flats.index')->with('success', 'Appartamento sponsorizzato con successo');
        } else {
            return response()->json(['message' => 'Transazione fallita.', 'error' => $result->message], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        // Genero il token
        $token = $gateway->clientToken()->generate();
        
        $data = [
            'success' => true,
            'token' => $token
        ];
        // Il token, verrà utilizzato nel front per il pagamento con carte di credito
        return response()->json($data, 200);
    }

    public function makePayment(PaymentRequest $request, Gateway $gateway){
        /* $result = Sponsor::find($request->sponsor); */
        
        $result = $gateway->transaction()->sale(
            [
                "amount" => "10.00",
                "paymentMethodNonce" => $request->token, //Token del plugin del front-end, ossia il secondo token che verrà inviato dal form
                "options" => [
                    "submitForSettlement" => true,
                ],
            ],
        );

        if($result->success){
            $data = [
                'success' => true,
                'message' => 'Transazione con successo!'
            ];
            return response()->json($data,200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Oops transazione fallita!'
            ];
            return response()->json($data,401);
        }
    }
}

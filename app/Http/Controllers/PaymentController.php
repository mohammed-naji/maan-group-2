<?php

namespace App\Http\Controllers;

use App\Services\HyperPay;
use Checkout\CheckoutApi;
use Illuminate\Http\Request;
use Checkout\Models\Payments\Payment;
use Checkout\Models\Payments\TokenSource;
// use Checkout\CheckoutApi;
// use Checkout\Models\Tokens\Card;
// use Checkout\Models\Payments\TokenSource;
// use Checkout\Models\Payments\Payment;

class PaymentController extends Controller
{
    public function payment()
    {
        $amount = 100;
        return view('payments.payment', compact('amount'));
    }

    public function paymentSubmit(Request $request)
    {
        $token = $request->token;
        $amount = $request->amount;
        // Set the secret key
        $secretKey = env('SK_CHECKOUT');

        // Initialize the Checkout API in Sandbox mode. Use new CheckoutApi($liveSecretKey, false); for production
        $checkout = new CheckoutApi($secretKey);

        // Create a payment method instance with card details
        $method = new TokenSource($token);

        // Prepare the payment parameters
        $payment = new Payment($method, 'USD');
        $payment->amount = $amount * 100; // = 10.00

        // Send the request and retrieve the response
        $response = $checkout->payments()->request($payment);

        if($response->status == 'Authorized') {
            return response()->json([
                'msg' => 'Payment Done Successfully',
                'type' => 'success'
            ]);
        }

        return response()->json([
            'msg' => 'Payment Faild',
            'type' => 'danger'
        ]);

    }

    function payment2() {
        $hyperpay = new HyperPay();
        $response = json_decode( $hyperpay->prepare(100), true );

        $id = $response['id'];

        return view('payments.payment2', compact('id'));
    }

    public function payment2_success(Request $request)
    {
        $resourcePath = $request->resourcePath;

        $hyperpay = New HyperPay();
        $response = json_decode( $hyperpay->payment($resourcePath), true );

        if($response['result']['code'] == '000.100.110') {
            return 'Success';
        }

        return 'Faild';

    }
}

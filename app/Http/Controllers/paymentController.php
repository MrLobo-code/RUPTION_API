<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use illuminate\Http\Request;

class paymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient([
                'api_key' => env('STRIPE_SECRET')
            ]);
            $stripe->paymentIntents->create([
                'amount' => intval($request->input('amount')),
                // 'amount' => 1000,
                'currency' => $request->input('currency'),
                // 'currency' => "usd",
                'automatic_payment_methods' => ['enabled' => true],
            ]);
            return response()->json([
                'message' => 'Payment successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

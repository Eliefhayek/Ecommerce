<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ecommpay\Payment;
use ecommpay\Gate;

class EcomController extends Controller
{
    //
    public function payment(Request $request){
    $user=Auth::guard('api')->user();
     if($user->email_verified_at==null){
            return response()->json('email not verified');
        }
    $payment = new Payment('186', 'TEST_1555943554067');
    $payment->setPaymentAmount(2000)->setPaymentCurrency('USD');
    $payment->setPaymentDescription('Test payment')->setTestMode();
    $gate=$gate = new Gate('<secret_key>');
    $url = $gate->getPurchasePaymentPageUrl($payment);
    // to be used to return user form
    return response()->json($url);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class productController extends Controller
{
    //
    public function show(){
    $user=Auth::guard('api')->user();
    $use=User::find($user->id);
    $intent=$use->createSetupIntent();
    return response()->json($intent);
    }
    public function purchase(Request $request)
{
    $user=Auth::guard('api')->user();
    $use=User::find($user->id);
    $intent=$use->createSetupIntent();
    $billing_details= 'elie';
    $payment_method= $request->payment_method;

    try {
        $use->createOrGetStripeCustomer();
        $use->updateDefaultPaymentMethod('pm_card_visa');
        $use->charge(20* 100,	'pm_card_visa');
    } catch (\Exception $exception) {
        return response()->json('failed');
    }

    return response()->json('Product purchased successfully!');
}
}

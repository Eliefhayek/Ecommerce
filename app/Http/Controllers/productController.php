<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class productController extends Controller
{
    //
    public function show(){
    /*$user=Auth::guard('api')->user();
    $use=User::find($user->id);*/
    $user=Auth::user();
    $intent=$user->createSetupIntent();
    return response()->json($intent);
    }
    public function purchase(Request $request)
{
    $user=Auth::guard('api')->user();
    //$use=User::find($user->id);
    $intent=$user->createSetupIntent();
    if($user->email_verified_at==null){
        return response()->json('email not verified');
    }
    try {
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod('pm_card_visa');
        $user->charge(20* 100,'pm_card_visa');
    } catch (\Exception $exception) {
        return response()->json('failed');
    }

    return response()->json('Product purchased successfully!');
}
}

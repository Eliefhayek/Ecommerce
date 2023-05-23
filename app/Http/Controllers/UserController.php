<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

public function Login(Request $request){
            $validedata=$request->validate([
                'email'=>'required|email',
                'password'=>'required|confirmed'
            ]);
          // $user = User::where('email', $request->email)->first();
            $credentials=$request->only('email','password');
            if(Auth::attempt($credentials)){
                $user=auth()->user();
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response()->json([
                    'status_code' => 200,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                  ]);
            }
            else{
                return response()->json('no good');
            }
        }
public function Signup(Request $request){

        $validedata=$request->validate([
            'email'=>'required|unique:users,email|email',
            'password'=>'required|confirmed',
            'name'=>'required',
        ]);
            $user=new User();
            $user->email=$validedata['email'];
            $user->password=Hash::make($validedata['password']);
            $user->name=$validedata['name'];
            $user->save();
            return response()->json(' good');
    }
public function test(){
    return response('done');
    $user=Auth::guard('api')->user();
    $use=User::find($user->id);
}

}

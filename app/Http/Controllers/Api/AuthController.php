<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ]);
        $user= User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $access_token_example = $user->createToken('MyApp')->access_token;
        return response()->json(['token'=>$access_token_example],200);
    }

    public function login(Request $request){
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){

            $user_login_token= auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }

    public function authenticated(){
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request -> validate([
            'name' => 'required',
            'email'=> 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'

        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password_confirmation'] = bcrypt($validatedData['password_confirmation']);

        $user = User::create($validatedData);
    
        if ($user){
            $accessToken = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status' => 200 ,
                'message' => 'Register successfully' 
            ],200);
        }else{
            return response()->json([
                'status' => 500 ,
                'message' =>  'something wrong'
            ],200);
        }
    }

    public function login(Request $request){
        $validatedData = $request -> validate([
            'email'=> 'required',
            'password' => 'required',
        ]);
        //The attempt method accepts an array of key / value pairs as its first argument. The values in the array will be used to find the user in your database table
        if(!auth() -> attempt($validatedData )){
            return response()->json([
                'status' => 401 ,
                'message' => 'invalid login' 
            ],200);
        }else{
            $accessToken =auth() -> user()->createToken('authToken')->accessToken;
            return response()->json([
                'status' => 200 ,
                'message' => 'Login successfully',
                'user' => auth() -> user(),
                'accessToken' => $accessToken
            ],200);
        }
    }
}

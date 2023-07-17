<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(Request $request){
        $user = auth() -> user();

        if(!Hash::check($request -> password , $user -> password)){
            return response()->json([
                'status' => 401 ,
                'message' => 'Your current password is incorrect',
            ],200);
        }

        $validatedData = $request -> validate([
            'password'=> 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        if($validatedData){
            $user -> password =bcrypt($validatedData['new_password']);
            if($user -> save()){
                return response()->json([
                    'status' => 401 ,
                    'message' => 'Your current password is change',
                ],200);
            }else{
                return response()->json([
                    'status' => 401 ,
                    'message' => 'Some error happened , please try again',
                ],500);
            }
        }
    }

    public function updateProfile(Request $request){

        $validatedData = $request -> validate([
            'name' => 'required',
            'email'=> 'required|unique:users',
        ]);
        
    
        if($validatedData){
            $user -> password =bcrypt($validatedData['new_password']);
            if($user -> save()){
                return response()->json([
                    'status' => 401 ,
                    'message' => 'Your current password is change',
                ],200);
            }else{
                return response()->json([
                    'status' => 401 ,
                    'message' => 'Some error happened , please try again',
                ],500);
            }
        }
    }
}

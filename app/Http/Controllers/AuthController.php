<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        try{
            if(!$request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ])){
                return response()->json(['error' => 'Validation failed'], 422);
            }
            
            return response()->json(['msg' => 'Login successful'], 200);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'Login failed'], 500);
        }
    }   
}

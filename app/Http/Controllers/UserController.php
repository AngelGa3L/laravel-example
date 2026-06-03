<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        try{
            $users = User::all();
            return response()->json($users, 200);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'Error fetching users'], 500);
        }
    }

    public function store(Request $request){
        try{
            if(!$request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ])){
                return response()->json(['error' => 'Validation failed'], 422);
            }
            $user = User::create($request->all());
            return response()->json($user, 201);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'Error creating user ' . $e->getMessage()], 500);
        }
    }

    public function show(int $id){
        try{
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(Request $request, int $id){
        try{
            $user = User::findOrFail($id);
            if(!$request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'password' => 'sometimes|required|string|min:8',
            ])){
                return response()->json(['error' => 'Validation failed'], 422);
            }
            $user->update($request->all());
            return response()->json(['msg' => 'User updated successfully', 'user' => $user], 200);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'Error updating user'], 500);
        }
    }

    public function destroy(int $id){
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['msg' => 'User deleted successfully'], 200);
        } 
        catch(\Exception $e){
            return response()->json(['error' => 'Error deleting user'], 500);
        }
    }
}

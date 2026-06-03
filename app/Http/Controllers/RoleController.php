<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json(['Users found',$roles], 200);
    }

    public function store(Request $request) {
        try{
            if(!$request -> validate([
            'name' => 'required|string|min:2'
            ])){
                return response()->json(['error' => 'Validation fail'], 422);
            };

            $role = Role::create([
                'name' => $request-> name
            ]);
            return response()->json(['Role created successfully', $role], 201);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error creating role ' . $e->getMessage()], 500);
        }
        
    }

    public function update(Request $request, int $id){
        try{
            $role = Role::findOrFail($id);
            if(!$request->validate([
                'name' => 'required|string|min:2'
            ])){
                return response()->json(['Invalid fields'], 200);
            }
            $role->update([
                'name' => $request -> name
            ]);

            return response()->json(['Role edited successfully', $role]);

        }catch(\Exception $e){
            return response()->json(['error' => 'Error update role ' . $e->getMessage()], 500);
        }
    }

    public function destroy(int $id){
        try{
            if(!$id)
            {
                return response()->json(['Role is required']);
            }
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json(['Role deleted successfully']);
        }catch(\Exception $e){
            return response()->json(['error' => 'Error update role ' . $e->getMessage()], 500);
        }
    }
}

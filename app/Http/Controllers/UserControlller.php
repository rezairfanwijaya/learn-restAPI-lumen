<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserControlller extends Controller
{
    public function register(Request $request)
    {
        // validasi data yang diinput user
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);


        // masukan data hasil validasi ke database
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    } 
    


    // function show all user
    public function showUser(){
        $user = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }
}

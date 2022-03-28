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
    
    // function login user
    public function login(Request $request){
        // validasi dan tampung data inputan user
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // cek apakah user dengan email tersebut ada di database ?
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => "User dengan email $email tidak ditemukan. Silahkan akses http://localhost:8000/user/register untuk daftar terlebih dahulu."
            ], 404);
        }

        // jika ada maka cek password
        // bandingkan password yang diinput user dengan password yang ada di database
        $validPassword = Hash::check($request->password, $user->password);
        if (!$validPassword) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password salah.'
            ], 401);
        }

        // jika email dan password benar maka generate token
        $generateToken = bin2hex(random_bytes(40));

        // lalu masukan token ke database dan update data user
        $user->update([
            'token' => $generateToken]
        );

        // jika semua tahapan sudah berhasil maka return response
        return response()->json([
            'status' => 'success',
            'data' => $user,
            'token' => $generateToken
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

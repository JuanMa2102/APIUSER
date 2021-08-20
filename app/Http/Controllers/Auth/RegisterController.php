<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        //encriptamos nuestro password
        $validateData['password'] = Hash::make($request->password);
        

        //guardamos nuestro usuario a la db
        $user = User::create($validateData);

        //creamos su accessToken
        $accessToken = $user->createToken('Token personal');

        return response()->json([
            'user' => $user,
            'access_token' => $accessToken->accessToken
        ]);
    }
}

<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        //vefiricar si las credenciales son validos mandar token de usuario
        //caso contrario mandar un mensaje:

        if(!Auth::attempt($credentials))
            return response([
                "message" => "Crendicales invalidos"
            ], 422);
        

        
        $user = $request->user();

        $accessToken = $user->createToken('Token personal');
       
        return response([
            "user" => $user,
            "access_token" => $accessToken->accessToken
        ]);
        
        
    }
    
    
    public function userActual(){
        $user = Auth::user();
        if(Auth::check()){
            return response([
                'user' => $user
            ]);
        }
    }

    //ceraamos sesion y anulamos token
    public  function logout(Request $request){
        $request->user()->token()->revoke();
        
        return response()->json([
            "message "=> "Successfully logged"
        ]);
    }
    
}

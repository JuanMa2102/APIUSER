<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
//use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword(ForgotRequest $request){
       
        //$email = $request->input('email');
        $data = $request->only('email');
        

        if(User::where('email', $data)->doesntExist()){
            return response([
                'message' => 'No existe el usuario'
            ], 404);
        }

        $token = Str::random(20);
        try{
        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $token
        ]);

        
        
        //enviar mensage
        $response = Password::sendResetLink($data);
        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully': 'ERROR SEND';
          return response()->json($message);

        }catch(\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }

    }

    public function resetPassword(ResetRequest $request){
        $data = $request->all();

         if(!$passwordResets = DB::table('password_resets')->where('token', $data['token'])->first()){
            return response([
                'message' => 'Token Invalido'
            ],400);
        }
        if(!$user = User::where('email', $passwordResets->email)->first()){
            return response([
                'message' => 'No existe el usuario'
            ],400);
        }

        $user['password'] = Hash::make($request->password);
        $user->save();
        return response([
            'message' => 'Reset success'
        ],200);
    }
}
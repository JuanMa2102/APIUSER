<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(){
       
        $user = User::all();
        return response([
                'user' => UserResource::collection($user),
                'message' => "Retrieveds successfully" 
        ], 200);
        
    }

    public function store(Request $request){
       $data = $request->all();
       $validator = Validator::make($data, [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required',
       ]);
       
       $data['password'] = Hash::make($request->password);

       if($validator->fails()){
           return response([
            'error' => $validator->errors(),
            'message' => 'Fail validation',
           ],400);
       }
        $user = User::create($data);
       
       return respose([
           'user' => new UserResource($user),
           'message' => 'Successfully create' 
       ], 200);
    }

    public function show(User $user){
        return response([
            'user' => new UserResource($user),
            'message' => 'Retrieveds successfully'
        ]);
    }

    public function update(Request $request, User $user){
        $user->update($request->all());
        
        return response([
            'user' => new UserResource($user),
            'message' => 'Retrieved successfully'
        ], 200);
    }
    public function destroy(User $user){
        
        $user->delete();
        return response([
            'message' => 'Deleted'
        ]);
    }

}

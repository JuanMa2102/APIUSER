<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos toda la colección de usuarios
        $user = User::all();
        return response([
            'user' => UserResource::collection($user),
            'message' => 'Retrieveds successfully'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'cp' => 'required|integer|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'profile' => 'required|string|max:255'
        ]);

        $data['password'] = Hash::make($request->password);

        if($validator->fails()){
            return response([
                'error' => $validator->errors(),
                'message' => 'Fail validation'
            ],400);
        }
        $user = User::create($data);

        return response([
            'user' => new UserResource($user),
            'message' => 'Successfully create'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return response([
            'user' => new UserResource($user),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $user->update($request->all());

        return response([
            'user' => new UserResource($user),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        
        return response([
            'message' => 'Delete successfully'
        ]);
    }
}

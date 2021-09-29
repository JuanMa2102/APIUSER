<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserHasModuleResource;
use App\Models\Module;
use App\Models\User;
use App\Models\User_has_module;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserHasModule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_has_module = User_has_module::all();
        return response()->json([
            'user_has_module' => new UserHasModuleResource($user_has_module),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $vaidator = Validator::make($data,[
            'id_user'=> 'reuquired',
            'id_module' => 'required'
        ]);
        if($vaidator->fails()){
            return response()->json([
                'error' => $vaidator->errors(),
                'message' => 'Fail validation'
            ],400);
        }
        
        $user = User::where('id', '=', $data['id_user'])->first();
        if($user == null){
            return response()->json([
                'message' => 'No existe este usuario, favor de verificar'
            ], 400);
        }

        $module = Module::where('id', '=', $data['id_module'])->first();
        if($module == null){
            return response()->json([
                'message' => 'No existe este modulo, favor de verificar'
            ], 400);
        }

        $user_has_module = User_has_module::create($data);
        return response()->json([
            'user_has_module' => new UserHasModuleResource($user_has_module),
            'message' => 'Successfully create'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user_has_module = User_has_module::find($id);
        if(empty($user_has_module)){
            return response()->json([
                'message' => 'User has module not exists'  
            ],400);
        }
        return response()->json([
            'user_has_module' => new UserHasModuleResource($user_has_module),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user_has_module = User_has_module::find($id);
        if(empty($user_has_module)){
            return response()->json([
                'message' => 'User has module not found'
            ],400);
        }
        $user_has_module->update($request->all());
        return response()->json([
            'user_has_module' => new UserHasModuleResource($user_has_module),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user_has_module = User_has_module::find($id);
        if(empty($user_has_module)){
            response()->json([
                'message' => 'User has module not found'
            ],400);
        }
        $user_has_module->delete($id);
        return response()->json([
            'message' => 'Delete successfully'
        ],200);
    }
}

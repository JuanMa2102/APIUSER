<?php

namespace App\Http\Controllers;

use App\Models\UnitUser;
use Illuminate\Http\Request;
use App\Http\Resources\UserUnitResource;
use App\Models\UnitBusiness;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_unit = UnitUser::all();
        return response()->json([
            'user_unit' =>  UserUnitResource::collection($user_unit),
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
        $validator = Validator::make($data,[
            'id_business_unit' => 'required',
            'id_user' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Fail validation'
            ], 400);
        }
        $business_unit = UnitBusiness::where('id', '=', $data['id_business_unit']);
        if($business_unit == null){
            return response()->json([
                'message' => 'No existe está unidad de negocio con este identificador, porfavor registra una unidad de negocio primero'
            ],400);
        }

        $user = User::where('id', '=', $data['id_user']);
        if($user == null){
            return response()->json([
                'message' => 'No existe este usuario con este identificador, porfavor registra un usuario primero'
            ],400);
        } 

        $user_unit = UnitUser::create($data);
        return response()->json([
            'user_unit' => new UserUnitResource($user_unit),
            'message' => 'Successfully create'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitUser  $unitUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user_unit = UnitUser::find($id);
        if(empty($user_unit)){
            return response()->json([
                'message' => 'User Unit not exists'
            ],400);
        }
        return response()->json([
            'user_unit' => new UserUnitResource($user_unit),
            'message' => 'Retrieveds successfully'
        ],200);
    }

//************************************************************************************************

    public function getUsuarios($id)
    {
        $user_unit = UnitUser::join( 'users','user_units.id_user','=', 'users.id' )
        ->select('user_units.id','users.name','users.phone', 'id_user','id_business_unit')
        ->where('id_business_unit', $id)
        ->get();
     
        if(empty($user_unit)){
            return response()->json([
                'message' => 'User has module not exists'  
            ],400);
        }
        return response()->json([
            'user_unit' => new UserUnitResource($user_unit),
            'message' => 'Retrieveds successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitUser  $unitUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user_unit = UnitUser::find($id);
        if(empty($user_unit)){
            response()->json([
                'message' => 'Business not exists'
            ],400);
        }

        $user_unit->update($request->all());
        return response()->json([
            'business' => new UserUnitResource($user_unit),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitUser  $unitUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user_unit = UnitUser::find($id);
        if(empty($user_unit)){
            return response()->json([
                'message' => 'Business not found'
            ],400);
        }
        
        $user_unit->delete($id);
        return response()->json([
            'message' => 'Delete successfully'
        ],200);
    }
}
